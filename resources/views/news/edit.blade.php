@extends('layout.master')

@section('title', 'Редактирование новости')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Отредактировать новость
        </h3>

        @include('posts.errors')

        <form action="{{ route('news.update', ['news' => $news->slug]) }}" method="POST">
            @csrf
            @method('patch')
            @include('news.form')
        </form>

        <form action="{{ route('news.destroy', ['news' => $news->slug]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger mb-2">Удалить новость</button>
        </form>

    </div><!-- /.blog-main -->

@endsection
