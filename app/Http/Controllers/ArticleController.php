<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:articles-create')->only('create');
        $this->middleware('permission:articles-read')->only('index');
        $this->middleware('permission:articles-update')->only('edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = QueryBuilder::for(Post::class)
            ->allowedFilters(['title', 'status', AllowedFilter::trashed()])
            ->allowedSorts(['title', 'status', 'views', 'created_at'])
            ->defaultSort('-id')
            ->with('author', 'categories')
            ->where('type', 'article')
            ->paginate()
            ->appends(request()->query());

        return view('dashboard.articles.lists', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('dashboard.articles.editor', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('type', 'article')
            ->firstOrFail();

        $categories = Category::get();
        
        return view('dashboard.articles.editor', compact('post', 'categories'));
    }
}
