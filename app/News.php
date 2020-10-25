<?php

namespace App;

use App\Traits\CacheFlushTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class News extends Model
{
    use CacheFlushTrait;

    protected $guarded = [];
    protected const SHORT_LENGTH = 200;
    protected const RELATED_TAGS = ['news'];

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
