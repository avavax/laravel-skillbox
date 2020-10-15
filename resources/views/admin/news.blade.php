@extends('layout.without_sidebar')

@section('title', 'Управление новостями')

@section('content')

    <div class="col-md-12 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Список новостей
        </h3>

        <table class="table">
            <thead>
            <tr>
                <td>id</td>
                <td>Заголовок</td>
                <td>Теги</td>
                <td>Редактировать</td>
            </tr>
            </thead>
            <tbody>

            @foreach($news as $oneNew)
                <tr>
                    <td>{{ $oneNew->id }}</td>
                    <td>{{ $oneNew->title }}</td>
                    <td></td>
                    <td><a href="{{ route('news.edit', ['news' => $oneNew->slug]) }}">Редактировать</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>

    </div><!-- /.blog-main -->

@endsection
