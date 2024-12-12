<x-layout-admin>
<form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="gambar_qris" class="form-label">Gambar QRIS</label>
        <input type="file" class="form-control" id="gambar_qris" name="gambar_qris" accept=".jpg,.jpeg,.png" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</x-layout-admin>