@extends('admin.layout')

@section('content')
<h2>Edit Produk</h2>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $product->title) }}">
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Brand</label>
        <input type="text" name="brand" class="form-control" value="{{ old('brand', $product->brand) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $product->description) }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col mb-3">
            <label class="form-label">Harga Diskon</label>
            <input type="number" name="discount_price" class="form-control" value="{{ old('discount_price', $product->discount_price) }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}">
        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Gambar Sekarang</label><br>
        <img src="{{ Storage::url($product->image) }}" width="100" height="100" style="object-fit:cover" class="mb-2"><br>
        <label class="form-label">Ganti Gambar (kosongkan jika tidak ingin ganti)</label>
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $product->is_active ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Aktif</label>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
