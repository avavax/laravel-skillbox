<?php

namespace App;

use App\Mail\PostCreated;
use App\Mail\PostDeleted;
use App\Mail\PostUpdated;
use App\Services\Pushall;
use App\Traits\CacheFlushTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Post extends Model
{
    use CacheFlushTrait;

    protected $guarded = [];
    protected const RELATED_TAGS = ['posts'];

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($post) {
            $fields = implode(',', array_diff(array_keys($post->getDirty()), ['updated_at']));
            $post->history()->attach(auth()->id(), ['changes' => $fields]);
            event(new \App\Events\PostUpdated($post, $fields));
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
