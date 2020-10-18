<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreBlogComment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth' , ['except' => ['index', 'show']]);
    }

     public function store(Request $request)
    {
        if ($request->segment(1) == 'news') {
            $type = \App\News::class;
            $idRule = 'exists:news,id';
        } else {
            $type = \App\Post::class;
            $idRule = 'exists:posts,id';
        }
        $attributes = $request->validate([
            'content' => 'required',
            'commentable_id' => $idRule,
        ]);
        $attributes = array_merge($attributes, [
            'author_id' => auth()->id(),
            'commentable_type' => $type,
        ]);
        Comment::create($attributes);
        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
