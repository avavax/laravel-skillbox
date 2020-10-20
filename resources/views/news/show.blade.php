@extends('layout.master')

@section('title', $news->title)

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $news->title }}
        </h3>

        <p class="blog-post-meta">{{ $news->created_at->format('Y-m-d H:i') }} </p>
        @include('tags.tags', ['tags' => $news->tags])

        {!! $news->content !!}

        <br><br><p><a href="{{ route('news.index') }}">К списку новостей</a></p><br>

        <p><strong>Комментарии</strong></p><hr>
        @forelse($news->comments as $comment)
            @include('comments.item', ['comment' => $comment])
        @empty
            <p>Без комментариев</p>
        @endforelse

        @auth
            @include('posts.errors')
            @include('comments.form', ['id' => $news->id, 'route' => 'news.comment.store'])
        @endauth

    </div><!-- /.blog-main -->

@endsection
