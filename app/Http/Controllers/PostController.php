<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('publication', 1)->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = $this->validate(request(), [
            'slug' => 'required|unique:posts,slug|regex:/^[a-z0-9_-]+$/i',
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'content' => 'required',
            'publication' =>'',
        ]);

        Post::create($post);

        return redirect()->route('main');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

     public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
