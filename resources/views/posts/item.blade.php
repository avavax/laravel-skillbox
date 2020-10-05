<div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at->format('Y-m-d H:i') }} </p>

    {{ $post->description }}

    <p><a href="/posts/{{ $post->slug }}">Читать далее...</a></p>
</div><!-- /.blog-post -->
