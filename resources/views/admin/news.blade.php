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
                    <td>{{ $oneNew->tags->pluck('name')->implode(',') }}</td>
                    <td><a href="{{ route('news.edit', ['news' => $oneNew->slug]) }}">Редактировать</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div><!-- /.blog-main -->

@endsection
