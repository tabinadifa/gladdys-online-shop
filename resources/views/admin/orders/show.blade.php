<x-layout-admin>
<a href="{{ route('orders.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<table class="table mt-4">
    <tr>
        <th>ID Order</th>
        <td>{{ $order->id }}</td>
    </tr>
    <tr>
        <th>Nama Pemesan</th>
        <td>{{ $order->name }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $order->phone }}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{ $order->address }}</td>
    </tr>
    <tr>
        <th>Total Harga</th>
        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <span class="badge 
                {{ $row->status == 'pending' ? 'bg-warning' : 
                        ($row->status == 'rejected' ? 'bg-danger' : 
                        ($row->status == 'process' ? 'bg-info' : 'bg-success')) }}">
                    {{ ucfirst($row->status) }}
            </span>
        </td>
    </tr>
    <tr>
        <th>Metode Pembayaran</th>
        <td>
    @if ($order->payment_method)
        <!-- Thumbnail Bukti Pembayaran -->
        <img src="{{ asset($order->payment_method) }}" 
     alt="Bukti Pembayaran" 
     class="img-thumbnail" 
     style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" 
     onclick="openImage('{{ $order->payment_method }}')">

    @else
        <span class="text-danger">No Payment Proof</span>
    @endif
</td>

    </tr>
    <tr>
        <th>Items</th>
        <td>
            @foreach (json_decode($order->cart_items, true) as $item)
                <div class="mb-2">
                    <strong>{{ $item['nama_produk'] }}</strong> - 
                    {{ $item['jumlah'] }} x Rp {{ number_format($item['harga_produk'], 0, ',', '.') }}<br>
                </div>
            @endforeach
        </td>
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
