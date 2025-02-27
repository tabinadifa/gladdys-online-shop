<x-layout-admin>
<a href="{{ route('products.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_produk" class="form-label">Nama Produk</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $product->nama_produk }}" required>
    </div>
    <div class="mb-3">
        <label for="kategori_produk" class="form-label">Kategori Produk</label>
        <select class="form-control" id="kategori_produk" name="kategori_produk" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($category as $row)
                <option value="{{ $row->id }}" {{ $product->kategori_produk == $row->id ? 'selected' : '' }}>
                    {{ $row->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="berat_produk" class="form-label">Berat Produk</label>
        <input type="number" class="form-control" id="berat_produk" name="berat_produk" value="{{ $product->berat_produk }}" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
        <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" required>{{ $product->deskripsi_produk }}</textarea>
    </div>
    <div class="mb-3">
        <label for="harga_produk" class="form-label">Harga Produk</label>
        <input type="number" class="form-control" id="harga_produk" name="harga_produk" value="{{ $product->harga_produk }}" required>
    </div>
    <div class="mb-3">
        <label for="diskon" class="form-label">Diskon (0 - 1, contoh: 0.1 untuk 10%)</label>
        <input type="number" step="0.01" class="form-control" id="diskon" name="diskon" value="{{ $product->diskon }}">
    </div>
    <div class="mb-3">
        <label for="gambar_produk" class="form-label">Gambar Produk</label>
        @if($product->gambar_produk)
            <p>Gambar saat ini: <img src="{{ asset($product->gambar_produk) }}" alt="Gambar Produk" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px;"></p>
        @endif
        <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" accept=".jpg,.jpeg,.png">
        <small class="form-text text-muted">Unggah gambar baru.</small>
    </div>
    <button type="submit" class="btn btn-info">Update</button>
</form>
</x-layout-admin>
