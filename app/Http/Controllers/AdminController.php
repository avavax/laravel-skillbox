<?php

namespace App\Http\Controllers;

use App\Jobs\BlogReport;
use App\Message;
use App\News;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function allPosts()
    {
        $posts = Cache::tags(['posts', 'tags'])->remember('admin-posts', 3600, function() {
            return Post::with('tags')->latest()->get();
        });
        return view('admin.posts', compact('posts'));
    }

    public function allNews()
    {
        $news = Cache::tags(['news', 'tags'])->remember('admin-news', 3600, function() {
            return News::with('tags')->latest()->get();
        });
        return view('admin.news', compact('news'));
    }

    public function allMessages()
    {
        $messages = Cache::tags(['message'])->remember('message', 3600, function() {
            return Message::latest()->get();
        });
        return view('admin.feedback', compact('messages'));
    }

    public function postPublicate(Post $post)
    {
        $post->update(['publication' => !$post->publication]);
        return redirect()->route('admin.posts');
    }

    public function statistics()
    {
        $data = Cache::tags(['posts', 'news', 'history', 'comments'])
            ->remember('statistics', 3600, function() {
                return [
                    'postsCount' => Post::count(),
                    'newsCount' => News::count(),
                    'maxPostsAuthor' => User::withCount('posts')->orderBy('posts_count', 'desc')->first(),
                    'maxLengthPost' => Post::OrderByRaw('LENGTH(content) DESC')->first(),
                    'minLengthPost' => Post::OrderByRaw('LENGTH(content)')->first(),
                    'avgPosts' => User::withCount('posts')->having('posts_count', '>', 1)->get()->avg('posts_count'),
                    'maxMutablePost' => Post::withCount('history')->orderBy('history_count', 'desc')->first(),
                    'maxCommentablePost' => Post::withCount('comments')->orderBy('comments_count', 'desc')->first(),
                ];
            });
        return view('admin.statistics', compact('data'));
    }

    public function report(Request $request)
    {
        BlogReport::dispatch($request->report_fields, auth()->user()->email);
        return view('admin.report');
    }
}
