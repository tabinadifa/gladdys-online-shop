<x-layout-admin>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nama_produk" class="form-label">Nama Produk</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
    </div>
    <div class="mb-3">
        <label for="kategori_produk" class="form-label">Kategori Produk</label>
        <select class="form-control" id="kategori_produk" name="kategori_produk" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($category as $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="berat_produk" class="form-label">Berat Produk</label>
        <input type="number" class="form-control" id="berat_produk" name="berat_produk" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
        <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" required></textarea>
    </div>
    <div class="mb-3">
        <label for="harga_produk" class="form-label">Harga Produk</label>
        <input type="number" class="form-control" id="harga_produk" name="harga_produk" required>
    </div>
    <div class="mb-3">
        <label for="diskon" class="form-label">Diskon (0 - 1, contoh: 0.1 untuk 10%)</label>
        <input type="number" step="0.01" class="form-control" id="diskon" name="diskon">
    </div>
    <div class="mb-3">
        <label for="gambar_produk" class="form-label">Gambar Produk</label>
        <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" accept=".jpg,.jpeg,.png">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</x-layout-admin>
