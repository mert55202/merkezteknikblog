@php $brand = $brand ?? null; @endphp
<div class="card mb-4">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Marka Adı *</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', optional($brand)->name ?? '') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Slug (boş bırakılırsa otomatik)</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', optional($brand)->slug ?? '') }}" placeholder="arcelik">
            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Açıklama</label>
            <textarea name="description" class="form-control" rows="2">{{ old('description', optional($brand)->description ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Sıra</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', optional($brand)->order ?? 0) }}">
        </div>
        <div class="form-check">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active', optional($brand)->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label">Aktif</label>
        </div>
    </div>
</div>
