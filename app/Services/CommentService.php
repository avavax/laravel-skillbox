<?php

namespace App\Services;

use App\Comment;

class CommentService
{
    public function store(int $id, array $attributes, string $type)
    {
        $attributes = array_merge($attributes, [
            'author_id' => auth()->id(),
            'commentable_type' => $type,
            'commentable_id' => $id,
        ]);
        Comment::create($attributes);
    }
}
