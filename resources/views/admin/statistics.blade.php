@extends('layout.without_sidebar')

@section('title', 'Статистика сайта')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Статистические данные
        </h3>

        <p>Общее количество статей - {{ $data['postsCount'] }}</p>
        <p>Общее количество новостей - {{ $data['newsCount']  }}</p>
        <p>Автор, у которого больше всего статей - {{ $data['maxPostsAuthor']->name  }}</p>
        <p>Самая длинная статья:
            <a href="{{ route('posts.show', ['post' => $data['maxLengthPost']->slug]) }}">
                {{ $data['maxLengthPost']->title  }}
            </a> - {{ $data['maxLengthPost']->content_length  }} знаков</p>
        <p>Самая короткая статья:
            <a href="{{ route('posts.show', ['post' => $data['minLengthPost']->slug]) }}">
                {{ $data['minLengthPost']->title  }}
            </a> - {{ $data['minLengthPost']->content_length  }} знаков</p>
        <p>Среднее количество статей у активных пользователей - {{ $data['avgPosts'] }}</p>

        @if($data['maxMutablePost'])
            <p>Чаще всего изменялась статья:
                <a href="{{ route('posts.show', ['post' => $data['maxMutablePost']->slug]) }}">
                    {{ $data['maxMutablePost']->title  }}
                </a></p>
        @else
            <p>В статьи не вносились изменения</p>
        @endif

        @if($data['maxCommentablePost'])
            <p>Самая комментируемая статья:
                <a href="{{ route('posts.show', ['post' => $data['maxCommentablePost']->slug]) }}">
                    {{ $data['maxCommentablePost']->title  }}
                </a></p>
        @else
            <p>Комментарии к статьям отсуствуют</p>
        @endif

    </div><!-- /.blog-main -->

@endsection
