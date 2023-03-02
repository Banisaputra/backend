<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Commodity;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pages-create')->only('create');
        $this->middleware('permission:pages-read')->only('index');
        $this->middleware('permission:pages-update')->only('edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = QueryBuilder::for(Post::class)
            ->allowedFilters(['title', 'status', AllowedFilter::trashed()])
            ->allowedSorts(['title', 'author.name', 'views', 'created_at'])
            ->defaultSort('-id')
            ->with('author')
            ->where('type', 'page')
            ->paginate()
            ->appends(request()->query());

        return view('dashboard.pages.lists', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.editor');
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
            ->where('type', 'page')
            ->firstOrFail();

        return view('dashboard.pages.editor', ['post' => $post]);
    }
    
    /**
     * Handle homepage resource
     *
     * @return \Illuminate\Http\Response
     */
    public function homepage()
    {
        $commodities = Commodity::with('lastPrice')->orderBy('name')->get();
        $latestPosts = Post::with('author')
            ->where('type', 'article')
            ->where('status', 'published')
            ->orderBy('id', 'desc')
            ->limit(get_cache('post_per_page'))
            ->get();
    
        return view('home', compact('commodities', 'latestPosts'));
    }
    
    /**
     * Handle gallery page resource
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery()
    {
        $gallery = Post::where('type', 'gallery')
            ->where('status', 'published')
            ->where('status', 'published')
            ->orderBy('id', 'desc')
            ->limit(get_cache('post_per_page'))
            ->get();
    
        return view('gallery', ['gallery' => $gallery]);
    }
    
    /**
     * Handle peta rawan pangan page resource
     *
     * @return \Illuminate\Http\Response
     */
    public function rawanPangan()
    {
        return view('peta-rawan-pangan');
    }
}
