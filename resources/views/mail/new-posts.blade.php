@component('mail::message')

# За период
# c {{ $start}} по {{ $finish}}
# были опубликованы следующие статьи

@foreach($posts as $post)
- [{{ $post->title }}]({{ route('posts.show', ['post' => $post->slug]) }})
@endforeach

Спасибо за внимание,<br>
{{ config('app.name') }}
@endcomponent
