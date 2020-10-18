@php
    $tags = $tags ?? collection();
@endphp

@if($tags->isNotEmpty())
    @foreach($tags as $tag)
        <a href="{{ route('tags.index', ['tag' => $tag->name]) }}">
            <p class="badge badge-secondary">{{ $tag->name }}</p>
        </a>
    @endforeach
    <br>
@endif
