<?php


namespace App\Services;


use App\Tag;

class TagService
{
    public function modify($teggable, $tagsFromRequest)
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
