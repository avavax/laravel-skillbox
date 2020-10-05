@extends('layout.master')

@section('title', 'Контакты')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Вы можете связаться с нами используя форму обратной связи
        </h3>

        @if($errors->count())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(Session::get('message'))
            <div class="alert alert-success">
                <p>{{ Session::get('message') }}</p>
            </div>
        @endif

        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Ваш e-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="content">Ваше сообщение</label>
                <textarea class="form-control" id="content" rows="3" name="content">{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Отправить сообщение</button>
        </form>

    </div><!-- /.blog-main -->

@endsection
