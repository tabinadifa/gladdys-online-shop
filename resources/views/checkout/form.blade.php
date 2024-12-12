<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl w-full bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-800">Form Checkout</h2>
            <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" class="space-y-4 mt-6">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap:</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('name') }}" required>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon:</label>
                    <input type="text" name="phone" id="phone" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 focus:ring-blue-500 focus:border-blue-500" 
                        value="{{ old('phone') }}" 
                        maxlength="15" 
                        required 
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat Pengiriman:</label>
                    <textarea name="address" id="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('address') }}</textarea>
                </div>

                <!-- Courier -->
                <div class="form-group">
                    <label for="courier" class="block text-sm font-medium text-gray-700">Kurir:</label>
                    <select name="courier" id="courier" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Kurir</option>
                        <option value="jne" {{ old('courier') == 'jne' ? 'selected' : '' }}>JNE</option>
                        <option value="pos" {{ old('courier') == 'pos' ? 'selected' : '' }}>POS</option>
                        <option value="tiki" {{ old('courier') == 'tiki' ? 'selected' : '' }}>TIKI</option>
                    </select>
                </div>

                <!-- Shipping Method -->
                <div class="form-group">
                    <label for="shipping_method" class="block text-sm font-medium text-gray-700">Pilih Ongkir:</label>
                    <select name="shipping_method" id="shipping_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Ongkir</option>
                        @foreach ($results['rajaongkir']['results'] as $courier)
                            @foreach ($courier['costs'] as $cost)
                                <option value="{{ $cost['cost'][0]['value'] }}">
                                    {{ $courier['name'] }} - {{ $cost['service'] }} (Rp {{ number_format($cost['cost'][0]['value'], 0, ',', '.') }})
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <!-- QRIS -->
                 <br>
                 <h3>Mohon lakukan pembayaran melalui QRIS di bawah ini:</h3>
                 @foreach ($payment as $row)
                <img src="{{ asset($row->gambar_qris) }}" alt="Gambar Produk" 
                    class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" 
                    onclick="openImage('{{ asset($row->gambar_qris) }}')">
                    @endforeach

                <!-- Payment Screenshot -->
                <div class="form-group">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Bukti Pembayaran (Screenshot):</label>
                    <input type="file" name="payment_method" id="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 focus:ring-blue-500 focus:border-blue-500" accept="image/*" required>
                </div>

                <!-- Total Price -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700">Total Harga:</label>
                    <p id="total_price_display" class="text-sm font-medium text-gray-800">Rp {{ number_format($totalProductPrice, 0, ',', '.') }}</p>
                    <input type="hidden" name="total_price" id="totalProductPrice" value="{{ $totalProductPrice }}">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                        Checkout
                    </button>
                </div>
            </form>
        </div>
    </div>
<!-- Modal Gambar Besar -->
<div id="imageModal" style="display: none;" onclick="closeImage()">
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); display: flex; justify-content: center; align-items: center;">
        <img id="largeImage" src="" alt="Gambar Besar" style="max-width: 90%; max-height: 90%; border-radius: 8px; cursor: pointer;">
    </div>
</div>
    <script>
    // Event listener untuk mengupdate total harga
    document.getElementById('shipping_method').addEventListener('change', function() {
        const shippingCost = parseInt(this.value) || 0; // Ambil nilai ongkos kirim
        const totalProductPrice = parseInt(document.getElementById('totalProductPrice').value); // Ambil harga produk dari elemen input
        const totalPrice = totalProductPrice + shippingCost;

        // Update tampilan total harga
        document.getElementById('total_price_display').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);

        // Update nilai total harga yang akan dikirim ke server
        document.getElementById('total_price').value = totalPrice;
    });
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

</x-layout>
