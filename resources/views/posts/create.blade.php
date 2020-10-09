@extends('layout.master')

@section('title', 'Добавление статьи')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Добавить статью
        </h3>

        @include('posts.errors')

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            @include('posts.form')
        </form>

    </div><!-- /.blog-main -->

@endsection
