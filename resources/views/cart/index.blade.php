<x-layout>
    <br><br><br>
    <div class="container mx-auto p-4">
    <a href="{{ route('order.index') }}" class="mt-4 px-4 py-2 bg-green-500 text-white text-sm rounded-md hover:bg-green-600 inline-block">Pesanan Anda</a>
        <h1 class="text-2xl font-bold mb-4">Keranjang Belanja</h1>

        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        @if(count($cart) > 0)
        <div class="space-y-4">
            @php $total = 0; @endphp
            @foreach ($cart as $id => $item)
            @php 
                $subtotal = $item['harga_produk'] * $item['jumlah']; 
                $total += $subtotal;
            @endphp
            <div class="flex items-center border border-gray- 300 p-4 rounded">
                <img src="{{ $item['gambar_produk'] }}" alt="{{ $item['nama_produk'] }}" class="w-20 h-20 mr-4">
                <div class="flex-grow">
                    <h2 class="text-lg font-semibold">{{ $item['nama_produk'] }}</h2>
                    <p>Harga: Rp {{ number_format($item['harga_produk'], 0, ',', '.') }}</p>
                    <p>Jumlah: {{ $item['jumlah'] }}</p>
                    <p>Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                    <form action="{{ route('cart.update', $id) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="1" class="w-16">
            <button type="submit" class="bg-blue-500 text-white px-2 py-1">Perbarui</button>
        </form>

                </div>
                <form action="{{ route('cart.remove', $id) }}" method="POST" class="ml-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Hapus</button>
                </form>
            </div>
            @endforeach
            <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Kosongkan Keranjang</button>
        </form>
        </div>
        <div class="mt-4">
            <h2 class="text-xl font-bold">Total: Rp {{ number_format($total, 0, ',', '.') }}</h2>
            <a href="{{ route('checkout.index') }}" class="mt-4 px-4 py-2 bg-green-500 text-white text-sm rounded-md hover:bg-green-600 inline-block">Lanjutkan ke Cek Ongkir</a>
        </div>
        @else
        <p>Keranjang Anda kosong.</p>
        @endif
    </div>
</x-layout>