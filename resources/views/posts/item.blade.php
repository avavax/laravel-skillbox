<div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at->format('Y-m-d H:i') }} </p>

    @include('posts.tags', ['tags' => $post->tags])

    {{ $post->description }}

    <p><a href="{{ route('posts.show', ['post' => $post->slug]) }}">Читать далее...</a></p>

    @can('update', $post)
        @admin
            <p><a href="{{ route('admin.posts') }}">Редактировать</a></p>
        @else
            <p><a href="{{ route('posts.edit', ['post' => $post->slug]) }}">Редактировать</a></p>
        @endadmin
    @endcan

</div><!-- /.blog-post -->
