@extends('layout.master')

@section('title', 'Список собщений')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Полученные сообщения
        </h3>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Текст</th>
                    <th scope="col">Дата</th>
                </tr>
            </thead>
            <tbody>

            @foreach($messages as $message)

                <tr>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->content }}</td>
                    <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
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
