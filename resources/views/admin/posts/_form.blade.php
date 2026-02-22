@php $post = $post ?? null; @endphp
<div class="card mb-4">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Kategori *</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id', optional($post)->category_id ?? '') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Başlık *</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', optional($post)->title ?? '') }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Slug (boş bırakılırsa otomatik)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', optional($post)->slug ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Özet</label>
            <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', optional($post)->excerpt ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">İçerik *</label>
            <textarea name="content" class="form-control" rows="12" required>{{ old('content', optional($post)->content ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Kapak Görseli</label>
            @if(optional($post)->image)
                <div class="mb-2"><img src="{{ \App\Helpers\ContentHelper::imageUrl(optional($post)->image ?? '') }}" alt="" style="max-height:120px;"></div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <hr>
        <h6>SEO</h6>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Meta Başlık</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', optional($post)->meta_title ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Yayın Tarihi</label>
                <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Meta Açıklama</label>
            <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', optional($post)->meta_description ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Meta Anahtar Kelimeler</label>
            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', optional($post)->meta_keywords ?? '') }}">
        </div>
        <div class="form-check">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" class="form-check-input" value="1" {{ old('is_published', optional($post)->is_published ?? true) ? 'checked' : '' }}>
            <label class="form-check-label">Yayında</label>
        </div>
    </div>
</div>
