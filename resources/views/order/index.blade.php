<x-layout>
    <br><br>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Pesanan Saya</h1>

    @if ($orders->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada pesanan yang dibuat.</p>
        </div>
    @else
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full border-collapse table-auto">
                <thead>
                    <tr class="bg-blue-500 text-white text-left">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Metode Pembayaran</th>
                        <th class="px-4 py-3">Kurier</th>
                        <th class="px-4 py-3">Total Harga</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Tanggal Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b last:border-none hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $order->address }}</td>
                            <td class="px-4 py-3 text-blue-500 underline">
                                <a href="{{ asset($order->payment_method) }}" target="_blank">Lihat Bukti</a>
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ $order->courier }}</td>
                            <td class="px-4 py-3 text-gray-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-sm font-medium
                                {{ $order->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : ($order->status == 'rejected' ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>

                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
</x-layout>
