<?php

namespace App;

use App\Mail\PostCreated;
use App\Mail\PostDeleted;
use App\Mail\PostUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Post extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        $adminEmail = Config::get('mail.admin_email');

        static::updated(function($post) use ($adminEmail) {
            \Mail::to($adminEmail)
                ->send(new PostUpdated($post));
        });
        static::created(function($post) use ($adminEmail) {
            \Mail::to($adminEmail)
                ->send(new PostCreated($post));
        });
        static::deleted(function($post) use ($adminEmail) {
            \Mail::to($adminEmail)
                ->send(new PostDeleted($post));
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
