<?php

namespace App\Http\Controllers;

use App\Message;
use App\News;
use App\Post;
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
        $data = [
            'postsCount' => DB::table('posts')->count(),
            'newsCount' => DB::table('news')->count(),
            'maxPostsAuthor' => DB::table('posts')
                ->select(DB::raw('COUNT(*) AS posts_count, name'))
                ->leftJoin('users', 'users.id', '=', 'posts.author_id')
                ->groupBy('name')
                ->max('name'),
            'maxLengthPost' => DB::table('posts')
                ->select(DB::raw('LENGTH(content) as length, title, slug'))
                ->orderBy('length', 'desc')
                ->first(),
            'minLengthPost' => DB::table('posts')
                ->select(DB::raw('LENGTH(content) as length, title, slug'))
                ->orderBy('length', 'asc')
                ->first(),
            'avgPosts' => DB::table('posts')
                ->select(DB::raw('COUNT(*) AS posts_count, name'))
                ->leftJoin('users', 'users.id', '=', 'posts.author_id')
                ->groupBy('name')
                ->pluck('posts_count')
                ->avg(),
            'maxMutablePost' => DB::table('posts')
                ->where('id', '=', DB::table('posts')
                    ->select(DB::raw('COUNT(post_id) AS mutable_count, post_id'))
                    ->leftJoin('post_histories', 'posts.id', '=', 'post_histories.post_id')
                    ->groupBy('post_id')
                    ->orderBy('mutable_count', 'desc')
                    ->first()->post_id
                )
                ->select('slug', 'title')
                ->first(),
                'maxCommentablePost' =>DB::table('posts')
                    ->where('id', DB::table('comments')
                        ->where('commentable_type', \App\Post::class)
                        ->select(DB::raw('COUNT(commentable_id) AS counts, commentable_id'))
                        ->leftJoin('posts', 'comments.commentable_id', '=', 'posts.id')
                        ->groupBy('commentable_id')
                        ->orderBy('counts', 'desc')
                        ->first()->commentable_id
                    )
                    ->select('slug', 'title')
                    ->first()
        ];
        return view('admin.statistics', compact('data'));
    }
}
