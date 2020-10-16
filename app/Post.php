<?php

namespace App;

use App\Mail\PostCreated;
use App\Mail\PostDeleted;
use App\Mail\PostUpdated;
use App\Services\Pushall;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Post extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Запись истории изменений

        static::updated(function ($post) {
            $fields = implode(',', array_diff(array_keys($post->getDirty()), ['updated_at']));
            $post->history()->attach(auth()->id(), ['changes' => $fields]);
        });

        // Отсылка собщений на почту админа

        /* $adminEmail = Config::get('app.admin_mail');

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
        });*/
     }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function tagsModify($tagsFromRequest)
    {
        if ($tagsFromRequest) {
            $tags = collect(explode(',', $tagsFromRequest))->keyBy(function($item) {return $item;});
        } else {
            $tags =collect([]);
        }
        $postTags = $this->tags->keyBy('name');
        $tagsToAttach = $tags->diffKeys($postTags);
        $tagsToDetach = $postTags->diffKeys($tags);

        foreach($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $this->tags()->attach($tag);
        }
        foreach($tagsToDetach as $tag) {
            $this->tags()->detach($tag);
        }
    }

    public function history()
    {
        return $this->belongsToMany(User::class, 'post_histories')
            ->withPivot(['changes'])
            ->withTimestamps();
    }
}
