<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPost;
use App\Post,
    App\Tag;

use App\Services\Pushall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        $this->authorize('create', Post::class);
        return view('posts.create');
    }

    public function store(StoreBlogPost $request, Pushall $pushall)
    {
        $this->authorize('create',  Post::class);
        $attributes = $request->validated();
        $attributes['author_id'] = auth()->id();
        $post = Post::create($attributes);

        if (request('tags')) {
            $post->tagsModify(request('tags'));
        }
        $this->pushall($post, $pushall);
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

    public function update(Post $post, StoreBlogPost $request)
    {
        $this->authorize('update', $post);
        $attributes = $request->validated();
        $post->update($attributes);
        $post->tagsModify(request('tags'));

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('update', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }

    private function pushall(Post $post, Pushall $pushall)
    {
        $data = [
            'title' => 'Создана статья',
            'text' => $post->title,
        ];
        $pushall->send($data['title'], $data['text']);
    }
}
