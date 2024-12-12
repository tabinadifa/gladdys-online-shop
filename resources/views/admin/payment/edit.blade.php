<x-layout-admin>
<a href="{{ route('payment.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<form action="{{ route('payment.update', $payment) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="gambar_qris" class="form-label"></label>
        @if($payment->gambar_qris)
            <p>Gambar saat ini: <img src="{{ asset($payment->gambar_qris) }}" alt="Gambar Produk" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px;"></p>
        @endif
        <input type="file" class="form-control" id="gambar_qris" name="gambar_qris" accept=".jpg,.jpeg,.png">
        <small class="form-text text-muted">Unggah gambar baru.</small>
    </div>
    <button type="submit" class="btn btn-info">Update</button>
</form>
</x-layout-admin>