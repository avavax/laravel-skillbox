<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Message extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function() {
            Cache::tags(['message'])->flush();
        });
    }
}
