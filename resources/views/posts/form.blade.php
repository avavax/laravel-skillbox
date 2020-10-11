<div class="form-group">
    <label for="title">Заголовок статьи</label>
    <input type="text" class="form-control" id="title" name="title"
            value="{{ old('title', $post->title)  }}">
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control" id="slug" name="slug"
           value="{{ old('slug', $post->slug) }}">
</div>
<div class="form-group">
    <label for="tags">Теги</label>
    <input type="text"
           class="form-control"
           id="tags"
           name="tags"
           value="{{ old('tags', $post->tags->pluck('name')->implode(',')) }}">
</div>
<div class="form-group">
    <label for="description">Краткое содержание статьи</label>
    <textarea class="form-control" id="description" rows="3" name="description">{{ old('description',$post->description) }}</textarea>
</div>
<div class="form-group">
    <label for="content">Текст статьи</label>
    <textarea class="form-control" id="content" rows="10" name="content">{{ old('content', $post->content) }}</textarea>
</div>
<div class="form-group form-check">
    <input type="checkbox" class="form-check-input"
           id="publication" name="publication" checked value="1">
    <label class="form-check-label" for="publication" >Опубликовать</label>
</div>
<button type="submit" class="btn btn-primary mb-2">Сохранить статью</button>
