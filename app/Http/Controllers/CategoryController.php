<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories-create')->only('store');
        $this->middleware('permission:categories-update')->only('edit', 'update');
        $this->middleware('permission:categories-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::get();
        $posts = Post::with('author')
            ->whereHas('categories', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->where('type', 'article')
            ->where('status', 'published')
            ->orderBy('id', 'desc')
            ->paginate(get_cache('post_per_page'));

        $archives = DB::table('posts')
            ->selectRaw('year(created_at) as year, month(created_at) as month, count(id) as posts')
            ->where('type', 'article')
            ->where('status', 'published')
            ->whereNull('deleted_at')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('category', compact('categories', 'posts', 'archives', 'category'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validateWithBag('categoryStoreForm', [
            'name' => 'required|min:3',
            'description' => 'nullable|max:400',
        ]);

        Category::create($data);

        notify('success', 'Kategori berhasil dibuat!');
        return redirect()->back()->with('active_tab', 'categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable|max:400',
        ]);

        $category->update($data);

        notify('success', 'Kategori berhasil diperbarui.');
        return redirect()->route('settings.index')->with('active_tab', 'categories')->send();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        notify('success', 'Kategori berhasil dihapus!');
        return redirect()->back()->with('active_tab', 'categories');
    }
}
