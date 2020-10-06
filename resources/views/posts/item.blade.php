<div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at->format('Y-m-d H:i') }} </p>

    @include('posts.tags', ['tags' => $post->tags])

    {{ $post->description }}

    <p><a href="{{ route('posts.show', ['post' => $post->slug]) }}">Читать далее...</a></p>
</div><!-- /.blog-post -->
