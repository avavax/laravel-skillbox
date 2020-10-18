<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function authorName()
    {
        return User::where('id', $this->author_id)->pluck('name')->first();
    }
}
