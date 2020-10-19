<form action="{{ route($route, ['id' => $id]) }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="content">Ваш комментарий</label>
        <textarea class="form-control" id="content" rows="3" name="content">{{ old('content') }}</textarea>
    </div>

    <input type="hidden" name="commentable_id" value="{{ $id }}">

<button type="submit" class="btn btn-primary mb-2">Добавить комментарий</button>
</form>
