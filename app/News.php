<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = [];
    protected const SHORT_LENGTH = 200;

    public function getShortContentAttribute()
    {
        return mb_substr($this->content, 0, self::SHORT_LENGTH);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
