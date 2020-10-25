<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait gCacheFlushTrait
{
    public static function bootCacheFlushTrait() {

        static::updated(function () {
            Cache::tags(static::RELATED_TAGS)->flush();
        });

        static::created(function() {
            Cache::tags(static::RELATED_TAGS)->flush();
        });

        static::deleted(function() {
            Cache::tags(static::RELATED_TAGS)->flush();
        });
    }
}
