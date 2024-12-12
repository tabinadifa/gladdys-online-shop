<x-layout-admin>
<a href="{{ route('products.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<table class="table mt-4">
    <tr>
        <th>Nama Produk</th> 
        <td>{{ $product->nama_produk }}</td> 
    </tr>
    <tr>
        <th>Kategori Produk</th>
        <td>{{ $product->kategori_produk }}</td>
    </tr>
    <tr>
        <th>Berat Produk</th>
        <td>{{ $product->berat_produk }} gram</td>
    </tr>
    <tr>
        <th>Harga Produk</th>
        <td>Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Gambar Produk</th>
        <td>
            @if ($product->gambar_produk)
                <!-- Thumbnail Gambar, klik untuk perbesar -->
                <img src="{{ asset($product->gambar_produk) }}" alt="Gambar Produk" 
                    class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" 
                    onclick="openImage('{{ asset($product->gambar_produk) }}')">
            @else
                <span class="text-danger">No Image</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Deskripsi Produk</th>
        <td>{{ $product->deskripsi_produk }}</td>
    </tr>
</table>

<!-- Modal Gambar Besar -->
<div id="imageModal" style="display: none;" onclick="closeImage()">
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); display: flex; justify-content: center; align-items: center;">
        <img id="largeImage" src="" alt="Gambar Besar" style="max-width: 90%; max-height: 90%; border-radius: 8px; cursor: pointer;">
    </div>
</div>
<script>
    // Fungsi untuk membuka gambar besar
    function openImage(imageSrc) {
        var modal = document.getElementById('imageModal');
        var largeImage = document.getElementById('largeImage');
        
        // Tampilkan modal dan gambar besar
        modal.style.display = 'block';
        largeImage.src = imageSrc;
    }

    // Fungsi untuk menutup gambar besar
    function closeImage() {
        var modal = document.getElementById('imageModal');
        
        // Sembunyikan modal
        modal.style.display = 'none';
    }
</script>

</x-layout-admin>
