@extends('layout.master')

@section('title', 'Добавление новости')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Добавить новость
        </h3>

        @include('posts.errors')

        <form action="{{ route('news.store') }}" method="POST">
            @csrf
            @include('news.form', ['news' => new \App\News()])
        </form>

    </div><!-- /.blog-main -->

@endsection
