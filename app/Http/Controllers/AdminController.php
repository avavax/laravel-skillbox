<?php

namespace App\Http\Controllers;

use App\Message;
use App\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function allPosts()
    {
        $posts = Post::with('tags')->latest()->get();
        return view('admin.posts', compact('posts'));
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
}