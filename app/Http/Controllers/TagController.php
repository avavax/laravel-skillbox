<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TagController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = Cache::tags(['posts', 'tags'])->remember('tag|posts', 3600, function() use ($tag) {
            return $tag->posts()->with('tags')->get();
        });
        $news = Cache::tags(['tags', 'news'])->remember('tag|posts', 3600, function() use ($tag) {
            return $tag->news()->with('tags')->get();
        });
        return view('tags.index', ['news' => $news, 'posts' => $posts, 'tag' => $tag ]);
    }
}
