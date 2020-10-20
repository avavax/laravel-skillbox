@extends('layout.master')

@section('title', 'Главная')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
           Новости с тегом {{ $tag->name }}
        </h3>

        @foreach($news as $oneNew)
            <div class="blog-post">
                <h2 class="blog-post-title">{{ $oneNew->title }}</h2>
                <p class="blog-post-meta">{{ $oneNew->created_at->format('Y-m-d H:i') }} </p>
                <p><a href="{{ route('news.show', ['news' => $oneNew->slug]) }}">Читать далее...</a></p>
            </div><!-- /.blog-post -->
        @endforeach

        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Статьи с тегом {{ $tag->name }}
        </h3>

        @foreach($posts as $post)
            <div class="blog-post">
                <h2 class="blog-post-title">{{ $post->title }}</h2>
                <p class="blog-post-meta">{{ $post->created_at->format('Y-m-d H:i') }} </p>
                <p><a href="{{ route('posts.show', ['post' => $post->slug]) }}">Читать далее...</a></p>
            </div><!-- /.blog-post -->
        @endforeach

    </div><!-- /.blog-main -->

@endsection
