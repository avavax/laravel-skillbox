<?php

namespace App\Http\Controllers;

use App\Mail\PostCreated,
    App\Post,
    App\Tag;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth' , ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = Post::where('publication', 1)->with('tags')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $attributes = $this->validatePost();
        $attributes['author_id'] = auth()->id();
        $post = Post::create($attributes);

        $tagsToAttach = collect(explode(',', request('tags')))->keyBy(function($item) {return $item;});
        if ($tagsToAttach) {
            foreach($tagsToAttach as $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $post->tags()->attach($tag);
            }
        }

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

     public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost(false);
        $post->update($attributes);

        $postTags = $post->tags->keyBy('name');
        $tags = collect(explode(',', request('tags')))->keyBy(function($item) {return $item;});
        $tagsToAttach = $tags->diffKeys($postTags);
        $tagsToDetach = $postTags->diffKeys($tags);

        foreach($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $post->tags()->attach($tag);
        }
        foreach($tagsToDetach as $tag) {
            $post->tags()->detach($tag);
        }
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('update', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }

    private function validatePost($isCreate = true)
    {
        $attributes = $this->validate(request(), [
            'slug' => ($isCreate ? 'unique:posts,slug' : '') . '|required|regex:/^[a-z0-9_-]+$/i',
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'content' => 'required',
        ]);
        return array_merge($attributes, ['publication' => request()->has('publication')]);
    }
}
