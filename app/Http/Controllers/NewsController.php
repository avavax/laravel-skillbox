<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogNews;
use App\News;
use App\Services\TagService;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function __construct() {
        $this->middleware('admin' , ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $news = News::latest()->simplePaginate(config('app.itemsOnPage'));
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(StoreBlogNews $request, TagService $tagService)
    {
        $attributes = $request->validated();
        $news = News::create($attributes);

        if (request('tags')) {
            $tagService->modify($news, request('tags'));
        }
        return redirect()->route('news.index');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(StoreBlogNews $request, News $news, TagService $tagService)
    {
        $attributes = $request->validated();
        $news->update($attributes);
        $tagService->modify($news, request('tags'));
        return redirect()->route('news.index');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index');
    }
}
