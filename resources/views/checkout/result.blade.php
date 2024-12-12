<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl w-full bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-800">Hasil Cek Ongkir</h2>
            <div class="mt-6">
                @if (isset($results['rajaongkir']['results']) && count($results['rajaongkir']['results']) > 0)
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Kurir</th>
                                <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Layanan</th>
                                <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Deskripsi</th>
                                <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Harga (Rp)</th>
                                <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Estimasi (Hari)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($results['rajaongkir']['results'] as $courier)
                                @foreach ($courier['costs'] as $cost)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-800">{{ $courier['name'] }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-800">{{ $cost['service'] }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-800">{{ $cost['description'] }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-800">{{ number_format($cost['cost'][0]['value'], 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-800">{{ $cost['cost'][0]['etd'] }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-800">Tidak ada hasil yang ditemukan.</p>
                @endif
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('checkout.index') }}" class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Kembali
                </a>
                <a href="{{ route('checkout.form') }}" class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Lanjut ke Checkout
                </a>
            </div>
        </div>
    </div>
</x-layout>
