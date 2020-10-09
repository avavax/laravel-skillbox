@component('mail::message')

# Внесены изменения в статью

{{ $post->title }}

@component('mail::button', ['url' => route('posts.show', ['post' => $post->slug])])
    Перейти
@endcomponent

Спасибо за внимание,<br>
{{ config('app.name') }}
@endcomponent
