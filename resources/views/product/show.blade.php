<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Gladdy's Case</title>
</head>

<body>
    <div class="container mx-auto p-4">
        <a href="{{ route('index') }}" class="w-full md:w-auto rounded bg-yellow-400 px-6 py-3 text-sm font-medium text-white hover:bg-yellow-500 focus:outline-none focus:ring">
            Kembali
        </a>
        <br><br>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Gambar Produk -->
            <div class="aspect-square bg-gray-100 overflow-hidden">
                <img src="{{ asset($product->gambar_produk) }}" alt="{{ $product->nama_produk }}" class="w-full h-50 object-cover">
            </div>

            <!-- Detail Produk -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $product->nama_produk }}</h1>
                <p class="mt-2 text-lg text-gray-700">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</p>
                <p class="mt-4 text-gray-600">{{ $product->deskripsi_produk }}</p>

                <form class="mt-6">
                    <button class="w-full md:w-auto rounded bg-yellow-400 px-6 py-3 text-sm font-medium text-white hover:bg-yellow-500 focus:outline-none focus:ring">
                        Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
