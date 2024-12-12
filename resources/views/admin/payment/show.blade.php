<x-layout-admin>
<a href="{{ route('payment.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<table class="table mt-4">
    <tr>
        <th>Gambar QRIS</th> 
        <td>
        @if ($payment->gambar_qris)
                <!-- Thumbnail Gambar, klik untuk perbesar -->
                <img src="{{ asset($payment->gambar_qris) }}" alt="Gambar QRIS" 
                    class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" 
                    onclick="openImage('{{ asset($payment->gambar_qris) }}')">
            @else
                <span class="text-danger">No Image</span>
            @endif
        </td> 
    </tr>
</table>
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