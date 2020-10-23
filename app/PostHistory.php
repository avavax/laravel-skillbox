<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PostHistory extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function() {
            Cache::tags(['history'])->flush();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
