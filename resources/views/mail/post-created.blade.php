@component('mail::message')

# Опубликована новая статья

{{ $post->title }}

@component('mail::button', ['url' => route('posts.show', ['post' => $post->slug])])
    Перейти
@endcomponent

Спасибо за внимание,<br>
{{ config('app.name') }}
@endcomponent


