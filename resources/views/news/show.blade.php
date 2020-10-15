@extends('layout.master')

@section('title', $news->title)

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $news->title }}
        </h3>

        <p class="blog-post-meta">{{ $news->created_at->format('Y-m-d H:i') }} </p>

        {!! $news->content !!}

        <br><br><p><a href="{{ route('news.index') }}">К списку новостей</a></p><br>

    </div><!-- /.blog-main -->

@endsection
