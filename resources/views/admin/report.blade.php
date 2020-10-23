@extends('layout.without_sidebar')

@section('title', 'Отчёт по сайту')

@section('content')

    <div class="col-md-12 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Данные для включения в отчёт
        </h3>
        <form action="{{ route('admin.report.send') }}" method="POST">
            @csrf
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="posts" value="posts" name="report_fields[]">
                <label class="form-check-label" for="posts">Статьи</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="news" value="news" name="report_fields[]">
                <label class="form-check-label" for="news">Новости</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="tags" value="tags" name="report_fields[]">
                <label class="form-check-label" for="tags">Теги</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="comments" value="comments" name="report_fields[]">
                <label class="form-check-label" for="comments">Комментарии</label>
            </div>
            <div class="form-check mb-5">
                <input class="form-check-input" type="checkbox" id="users" value="users" name="report_fields[]">
                <label class="form-check-label" for="users">Пользователи</label>
            </div>
            <button type="submit" class="btn btn-info mb-2">Отправить отчёт</button>
        </form>
        <div id="report" class="mt-3 mb-5"></div>
    </div><!-- /.blog-main -->


@endsection
