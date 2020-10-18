<div class="form-group">
    <label for="title">Заголовок новости</label>
    <input type="text" class="form-control" id="title" name="title"
            value="{{ old('title', $news->title)  }}">
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control" id="slug" name="slug"
           value="{{ old('slug', $news->slug) }}">
</div>
<div class="form-group">
    <label for="tags">Теги</label>
    <input type="text"
           class="form-control"
           id="tags"
           name="tags"
           value="{{ old('tags', $news->tags->pluck('name')->implode(',')) }}">
</div>
<div class="form-group">
    <label for="content">Текст новости</label>
    <textarea class="form-control" id="content" rows="10" name="content">{{ old('content', $news->content) }}</textarea>
</div>

<button type="submit" class="btn btn-primary mb-2">Сохранить новость</button>
