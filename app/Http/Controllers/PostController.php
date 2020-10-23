<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPost;
use App\Post,
    App\Tag;

use App\Services\Pushall;
use App\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth' , ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = Cache::tags(['posts', 'tags', 'comments', 'history'])->remember('posts', 3600, function() {
            return Post::where('publication', 1)
                ->with('tags')
                ->with('comments')
                ->latest()
                ->simplePaginate(config('app.itemsOnPage'));

        });
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);
        return view('posts.create');
    }

    public function store(StoreBlogPost $request, Pushall $pushall, TagService $tagService)
    {
        $this->authorize('create',  Post::class);
        $attributes = $request->validated();
        $attributes['author_id'] = auth()->id();
        $post = Post::create($attributes);

        if (request('tags')) {
            $tagService->modify($post, request('tags'));
        }
        $this->pushall($post, $pushall);
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        $post = Cache::tags(['posts', 'tags', 'comments', 'history'])
            ->remember('post|' . $post->id, 3600, function() use ($post) {
                return $post;
            });
        return view('posts.show', compact('post'));
    }

     public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, StoreBlogPost $request, TagService $tagService)
    {
        $this->authorize('update', $post);
        $attributes = $request->validated();
        $post->update($attributes);
        $tagService->modify($post, request('tags'));

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
