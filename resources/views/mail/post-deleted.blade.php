@component('mail::message')
# Удалена статья

{{ $post->title }}

Спасибо за внимание,<br>
{{ config('app.name') }}
@endcomponent
