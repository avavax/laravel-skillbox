@component('mail::message')
# Отчёт по блогу

@foreach($counters as $key => $count)
- {{ $key }} : {{ $count }}
@endforeach

@component('mail::button', ['url' => route('main')])
Перейти на сайт
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
