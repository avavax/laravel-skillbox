<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Tag $tag)
    {
        $news = $tag->news()->with('tags')->get();
        $posts = $tag->posts()->with('tags')->get();
        return view('tags.index', ['news' => $news, 'posts' => $posts, 'tag' => $tag ]);
    }
}
