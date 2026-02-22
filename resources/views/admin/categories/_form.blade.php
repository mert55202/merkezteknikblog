@php $category = $category ?? null; @endphp
<div class="card mb-4">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Kategori Adı *</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', optional($category)->name ?? '') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Slug (boş bırakılırsa otomatik)</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', optional($category)->slug ?? '') }}" placeholder="beyaz-esya">
            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Açıklama</label>
            <textarea name="description" class="form-control" rows="2">{{ old('description', optional($category)->description ?? '') }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Meta Başlık (SEO)</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', optional($category)->meta_title ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Sıra</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', optional($category)->order ?? 0) }}">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Meta Açıklama (SEO)</label>
            <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', optional($category)->meta_description ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Görsel</label>
            @if(optional($category)->image)
                <div class="mb-2"><img src="{{ \App\Helpers\ContentHelper::imageUrl(optional($category)->image ?? '') }}" alt="" style="max-height:80px;"></div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <div class="form-check">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active', optional($category)->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label">Aktif</label>
        </div>
    </div>
</div>
