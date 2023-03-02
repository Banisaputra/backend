<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:galleries-create')->only('create');
        $this->middleware('permission:galleries-read')->only('index');
        $this->middleware('permission:galleries-update')->only('edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = QueryBuilder::for(Post::class)
            ->allowedFilters(['title', 'status', AllowedFilter::trashed()])
            ->allowedSorts(['title', 'author.name', 'views', 'created_at'])
            ->defaultSort('-id')
            ->with('author')
            ->where('type', 'gallery')
            ->paginate()
            ->appends(request()->query());

        return view('dashboard.galleries.lists', ['galleries' => $galleries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.galleries.editor');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('type', 'gallery')
            ->firstOrFail();

        return view('dashboard.galleries.editor', ['post' => $post]);
    }
}
