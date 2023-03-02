<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'title' => 'required|string',
            'content' => 'sometimes|nullable|array',
            'content.*.type' => 'required|in:header,paragraph,image,table,list,raw,embed,attaches,delimiter',
            'type' => 'required|in:gallery,article,page,revision',
        ]);

        if ($validator->fails()) {          
            return response()->json($validator->messages(), 400);                        
        }
        
        $request->merge(['user_id' => Auth()->user()->id]);
        return DB::transaction(function () use ($request) {
            $post = Post::create($request->all());

            if ($post->type === 'article') {
                $post->categories()->sync($request->input('category'));
            }
            
            return response()->json($post);
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [ 
            'title' => 'required|string',
            'content' => 'sometimes|nullable|array',
            'content.*.type' => 'required|in:header,paragraph,image,table,list,raw,embed,attaches,delimiter',
            'type' => 'sometimes|nullable|in:gallery,article,page,revision',
            'status' => 'sometimes|nullable|in:draft,published,inherit',
        ]);

        if ($validator->fails()) {          
            return response()->json($validator->messages(), 400);                        
        }

        return DB::transaction(function () use ($request, $post) {
            if ($post->type === 'article') {
                $post->categories()->sync($request->input('category'));
            }
            
            $post->update($request->except(['user_id', 'slug']));
            return response()->json($post->refresh());
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        notify('success', ucwords($post->type) . ' berhasil dihapus!');
        return redirect()->back();
    }

    /**
     * Untrash the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function untrash($id)
    {
        Post::onlyTrashed()->where('id', $id)->restore();
        $post = Post::where('id', $id)->first();
        notify('success', ucwords($post->title) . ' berhasil direstore!');
        return redirect()->route(\Str::plural($post->type).'.index');
    }

    /**
     * Bulk action the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkaction(Request $request)
    {
        if (!in_array($request->action, ['published', 'draft', 'trash', 'restore'])) {
            notify('error', 'Bulk action tidak dapat dijalankan.');
            return;
        }

        if ($request->action === 'trash') {
            Post::whereIn('id', $request->post_id)->delete();
            notify('success', count($request->post_id) . ' item berhasil dihapus!');
        } else if ($request->action === 'restore') {
            Post::onlyTrashed()->whereIn('id', $request->post_id)->restore();
            notify('success', count($request->post_id) . ' item berhasil direstore!');
        } else {
            Post::whereIn('id', $request->post_id)->update([
                'status' => $request->action,
            ]);
            notify('success', count($request->post_id) . ' item berhasil diubah!');
        }

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        $categories = Category::get();
        $posts = QueryBuilder::for(Post::class)
            ->allowedFilters([
                AllowedFilter::partial('q', 'title'), 
                AllowedFilter::scope('date'), AllowedFilter::scope('category')
            ])
            ->defaultSort('-id')
            ->with('author')
            ->where('type', 'article')
            ->where('status', 'published')
            ->paginate(get_cache('post_per_page'))
            ->appends(request()->query());

        $archives = DB::table('posts')
            ->selectRaw('year(created_at) as year, month(created_at) as month, count(id) as posts')
            ->where('type', 'article')
            ->where('status', 'published')
            ->whereNull('deleted_at')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('blog', compact('categories', 'posts', 'archives'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if ($post->status !== 'published' && (!Auth()->check() || (Auth()->check() && !Auth()->user()->owns($post)))) {
            abort(404);
        }
        
        views($post)->cooldown(60)->record();
        return view('posts.index', ['post' => $post]);
    }
}
