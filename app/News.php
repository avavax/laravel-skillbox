<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class News extends Model
{
    protected $guarded = [];
    protected const SHORT_LENGTH = 200;

    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            Cache::tags(['news'])->flush();
        });

        static::created(function() {
            Cache::tags(['news'])->flush();
        });

        static::deleted(function() {
            Cache::tags(['news'])->flush();
        });
    }

    public function getShortContentAttribute()
    {
        return mb_substr($this->content, 0, self::SHORT_LENGTH);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
