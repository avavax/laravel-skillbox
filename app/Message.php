<?php

namespace App;

use App\Traits\CacheFlushTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Message extends Model
{
    use CacheFlushTrait;

    protected $guarded = [];
    protected const RELATED_TAGS = ['message'];
}
