<div class="row alert alert-warning mb-3">
    <div class="col-3">
        <p>{{ $comment->authorName() }}</p>
        <small>{{ $comment->created_at->format('Y-m-i H:i') }}</small>
    </div>
    <div class="col-9">
        <p>{{ $comment->content }}</p>
    </div>

    @admin
    <div class="col-12">
        <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger mt-2 mb-2">Удалить комментарий</button>
        </form>
    </div>
    @endadmin
</div>

