<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

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

    public function tagsModify($teggable, $tagsFromRequest)
    {
        if ($tagsFromRequest) {
            $tags = collect(explode(',', $tagsFromRequest))->keyBy(function($item) {return $item;});
        } else {
            $tags = collect([]);
        }
        $postTags = $teggable->tags->keyBy('name');
        $tagsToAttach = $tags->diffKeys($postTags);
        $tagsToDetach = $postTags->diffKeys($tags);

        foreach($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $teggable->tags()->attach($tag);
        }
        foreach($tagsToDetach as $tag) {
            $teggable->tags()->detach($tag);
        }
    }

}
