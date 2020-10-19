@extends('layout.master')

@section('title', $post->title)

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $post->title }}
        </h3>

        <p class="blog-post-meta">{{ $post->created_at->format('Y-m-d H:i') }} </p>
        @include('tags.tags', ['tags' => $post->tags])

        {!! $post->content !!}

        <p><a href="{{ route('posts.index') }}">К списку статей</a></p><br>

        @admin
            @if($post->history->isEmpty())
                <p>Нет изменений</p>
            @else
            <p>История изменений</p>
            <table class="table">
                <tr>
                    <td>Автор изменений</td>
                    <td>Дата</td>
                    <td>Изменённые поля</td>
                </tr>
                @foreach($post->history as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->pivot->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $item->pivot->changes }}</td>
                    </tr>
                @endforeach
            </table>
            @endif
        @endadmin

        <p><strong>Комментарии</strong></p><hr>
        @forelse($post->comments as $comment)
            @include('comments.item', ['comment' => $comment])
        @empty
             <p>Без комментариев</p>
        @endforelse

        @auth
            @include('posts.errors')
            @include('comments.form', ['id' => $post->id, 'route' => 'posts.comment.store'])
        @endauth

    </div><!-- /.blog-main -->

@endsection
