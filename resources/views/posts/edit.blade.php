@extends('layout.master')

@section('title', 'Редактирование статьи')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Отредактировать статью
        </h3>

        @include('posts.errors')

        <form action="{{ route('posts.update', ['post' => $post->slug]) }}" method="POST">
            @csrf
            @method('patch')
            @include('posts.form')
        </form>

        <form action="{{ route('posts.destroy', ['post' => $post->slug]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger mb-2">Удалить статью</button>
        </form>

    </div><!-- /.blog-main -->

@endsection
