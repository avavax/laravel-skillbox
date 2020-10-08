@extends('layout.master')

@section('title', 'Добавление статьи')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Добавить статью
        </h3>

        @if($errors->count())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Заголовок статьи</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
            </div>
            <div class="form-group">
                <label for="tags">Теги</label>
                <input type="text"
                       class="form-control"
                       id="tags"
                       name="tags"
                       value="{{ old('tags') }}">
            </div>
            <div class="form-group">
                <label for="description">Краткое содержание статьи</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Текст статьи</label>
                <textarea class="form-control" id="content" rows="10" name="content">{{ old('content') }}</textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="publication" name="publication" value="1">
                <label class="form-check-label" for="publication" >Опубликовать</label>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Сохранить статью</button>
        </form>

    </div><!-- /.blog-main -->

@endsection
