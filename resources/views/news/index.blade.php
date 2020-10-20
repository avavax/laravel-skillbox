@extends('layout.master')

@section('title', 'Новости')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Последние новости
        </h3>

        @foreach($news as $oneNew)

            @include('news.item')

        @endforeach

        {{ $news->links() }}

    </div><!-- /.blog-main -->

@endsection
