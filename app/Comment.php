<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function() {
            Cache::tags(['comments'])->flush();
        });
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
