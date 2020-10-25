<?php

namespace App;

use App\Traits\CacheFlushTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PostHistory extends Model
{
    use CacheFlushTrait;

    protected $guarded = [];
    protected const RELATED_TAGS = ['history'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
