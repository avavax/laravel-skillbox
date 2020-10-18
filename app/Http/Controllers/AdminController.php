<?php

namespace App\Http\Controllers;

use App\Message;
use App\News;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function allPosts()
    {
        $posts = Post::with('tags')->latest()->get();
        return view('admin.posts', compact('posts'));
    }

    public function allNews()
    {
        $news = News::with('tags')->latest()->get();
        return view('admin.news', compact('news'));
    }

    public function allMessages()
    {
        $messages = Message::latest()->get();
        return view('admin.feedback', compact('messages'));
    }

    public function postPublicate(Post $post)
    {
        $post->update(['publication' => !$post->publication]);
        return redirect()->route('admin.posts');
    }

    public function statistics()
    {
        $posts = Post::get();
        $data = [
            'postsCount' => $posts->count(),
            'newsCount' => News::count(),
            'maxPostsAuthor' => User::withCount('posts')->orderBy('posts_count', 'desc')->first(),
            'maxLengthPost' => $posts->sortByDesc('content_length')->first(),
            'minLengthPost' => $posts->sortBy('content_length')->first(),
            'avgPosts' => User::withCount('posts')->get()->where('posts_count', '>', 1)->pluck('posts_count')->avg(),
            'maxMutablePost' => Post::withCount('history')->orderBy('history_count', 'desc')->first(),
            'maxCommentablePost' => Post::withCount('comments')->orderBy('comments_count', 'desc')->first(),
        ];
        return view('admin.statistics', compact('data'));
    }
}
