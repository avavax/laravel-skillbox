<?php

namespace App;

use App\Traits\CacheFlushTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tag extends Model
{
    use CacheFlushTrait;

    protected $guarded = [];
    protected const RELATED_TAGS = ['tags'];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
