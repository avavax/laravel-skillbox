@extends('layout.without_sidebar')

@section('title', 'Управление статьями')

@section('content')

    <div class="col-md-12 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Список статей
        </h3>

        <table class="table">
            <thead>
            <tr>
                <td>id</td>
                <td>Заголовок</td>
                <td>Теги</td>
                <td>Статус</td>
                <td>Редактировать</td>
            </tr>
            </thead>
            <tbody>

            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>@include('tags.tags', ['tags' => $post->tags])</td>
                    <td>
                        <form action="{{ route('admin.posts.publicate', ['post' => $post->slug]) }}" method="POST">
                            @csrf
                            @method('patch')
                            <input type="checkbox" class="form-check-input"
                                   id="{{ $post->slug }}" name="publication" value="1"
                                   {{ $post->publication ? 'checked' : ''}}
                                    onclick="this.form.submit()">
                            <label class="form-check-label" for="{{ $post->slug }}" >
                                {{ $post->publication ? 'Опубликовано' : 'Снято с ленты' }}
                            </label>
                        </form>

                    </td>
                    <td><a href="{{ route('posts.edit', ['post' => $post->slug]) }}">Редактировать</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div><!-- /.blog-main -->

@endsection
