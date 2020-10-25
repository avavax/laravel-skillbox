<?php

namespace App;

use App\Traits\CacheFlushTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use CacheFlushTrait;

    protected $guarded = [];
    protected const RELATED_TAGS = ['comments'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
