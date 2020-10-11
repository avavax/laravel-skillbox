@extends('layout.master')

@section('title', $post->title)

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $post->title }}
        </h3>

        <p class="blog-post-meta">{{ $post->created_at->format('Y-m-d H:i') }} </p>
        @include('posts.tags', ['tags' => $post->tags])

        {!! $post->content !!}

        <p><a href="{{ route('posts.index') }}">К списку статей</a></p>
        @can('update', $post)
            <p><a href="{{ route('posts.edit', ['post' => $post->slug]) }}">Редактировать</a></p>
        @endcan
    </div><!-- /.blog-main -->

@endsection
