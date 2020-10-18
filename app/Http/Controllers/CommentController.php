<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function storeFromPost(Request $request)
    {
        $attributes = $request->validate([
            'content' => 'required',
            'commentable_id' => 'exists:posts,id',
        ]);

        $this->store($attributes, \App\Post::class);
        return back();
    }

    public function storeFromNews(Request $request)
    {
        $attributes = $request->validate([
            'content' => 'required',
            'commentable_id' => 'exists:news,id',
        ]);

        $this->store($attributes, \App\News::class);
        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }

    private function store(array $attributes, string $type)
    {
        $attributes = array_merge($attributes, [
            'author_id' => auth()->id(),
            'commentable_type' => $type,
        ]);
        Comment::create($attributes);
    }

}
