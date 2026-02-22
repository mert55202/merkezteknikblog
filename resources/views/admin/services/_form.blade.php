@php $service = $service ?? null; @endphp
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Markalar (birden fazla seçebilirsiniz)</label>
                <select name="brand_ids[]" class="form-select" multiple size="6">
                    @foreach($brands as $b)
                        <option value="{{ $b->id }}" {{ in_array($b->id, old('brand_ids', $service ? $service->brands->pluck('id')->toArray() : [])) ? 'selected' : '' }}>{{ $b->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Ctrl/Cmd ile çoklu seçim</small>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kategoriler (birden fazla seçebilirsiniz)</label>
                <select name="category_ids[]" class="form-select" multiple size="6">
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ in_array($c->id, old('category_ids', $service ? $service->categories->pluck('id')->toArray() : [])) ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Ctrl/Cmd ile çoklu seçim</small>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Başlık *</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', optional($service)->title ?? '') }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Slug (boş bırakılırsa otomatik)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', optional($service)->slug ?? '') }}">
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Sıra</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', optional($service)->order ?? 0) }}" min="0">
                <small class="text-muted">Küçük numara önce gösterilir.</small>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Telefon</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', optional($service)->phone ?? '') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Adres</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', optional($service)->address ?? '') }}">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Özet</label>
            <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', optional($service)->excerpt ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">İçerik *</label>
            <textarea name="content" class="form-control" rows="8" required>{{ old('content', optional($service)->content ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Görsel</label>
            @if(optional($service)->image)
                <div class="mb-2"><img src="{{ \App\Helpers\ContentHelper::imageUrl(optional($service)->image) }}" alt="" style="max-height:120px;"></div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <hr>
        <h6>SEO & Yayın</h6>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Meta Başlık</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', optional($service)->meta_title ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Yayın Tarihi</label>
                <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', optional($service)->published_at?->format('Y-m-d\TH:i') ?? now()->format('Y-m-d\TH:i')) }}">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Meta Açıklama</label>
            <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', optional($service)->meta_description ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Meta Anahtar Kelimeler</label>
            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', optional($service)->meta_keywords ?? '') }}">
        </div>
        <div class="form-check">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" class="form-check-input" value="1" {{ old('is_published', optional($service)->is_published ?? true) ? 'checked' : '' }}>
            <label class="form-check-label">Yayında</label>
        </div>
    </div>
</div>
