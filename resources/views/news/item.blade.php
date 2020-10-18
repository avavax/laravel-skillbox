<div class="blog-post">
    <h3 class="blog-post-title">{{ $oneNew->title }}</h3>
    <p class="blog-post-meta">{{ $oneNew->created_at->format('Y-m-d H:i') }} </p>

    @include('tags.tags', ['tags' => $oneNew->tags])

    {{ $oneNew->short_content }}

    <p><a href="{{ route('news.show', ['news' => $oneNew->slug]) }}">Читать далее...</a></p>

</div><!-- /.blog-post -->
