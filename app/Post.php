<?php

namespace App;

use App\Mail\PostCreated;
use App\Mail\PostDeleted;
use App\Mail\PostUpdated;
use App\Services\Pushall;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Post extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($post) {
            $fields = implode(',', array_diff(array_keys($post->getDirty()), ['updated_at']));
            $post->history()->attach(auth()->id(), ['changes' => $fields]);
            event(new \App\Events\PostUpdated($post, $fields));

            Cache::tags(['posts'])->flush();
        });

        static::created(function() {
            Cache::tags(['posts'])->flush();
        });

        static::deleted(function() {
            Cache::tags(['posts'])->flush();
        });
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

    public function history()
    {
        return $this->belongsToMany(User::class, 'post_histories')
            ->withPivot(['changes'])
            ->withTimestamps();
    }

    public function getContentLengthAttribute()
    {
        return mb_strlen($this->content);
    }
}
