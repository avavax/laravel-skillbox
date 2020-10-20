<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreBlogComments;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function storeFromPost($id, StoreBlogComments $request, CommentService $commentService)
    {
        $attributes = $request->validated();
        $commentService->store($id, $attributes, \App\Post::class);
        return back();
    }

    public function storeFromNews($id, StoreBlogComments $request, CommentService $commentService)
    {
        $attributes = $request->validated();
        $commentService->store($id, $attributes, \App\News::class);
        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
