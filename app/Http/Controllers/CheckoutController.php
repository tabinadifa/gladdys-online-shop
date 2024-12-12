<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Payment;

class CheckoutController extends Controller
{
    public function index()
{
    // Ambil data keranjang dari session
    $cart = session('cart', []);

    // Hitung total berat produk dalam gram
    $totalWeight = 0;

    foreach ($cart as $item) {
        $weight = $item['berat_produk'] ?? 0; // Berikan nilai default jika tidak ada
        $totalWeight += $weight * $item['jumlah'];
    }

    // Ambil data kota dari API RajaOngkir atau dari cache
    $response = Http::withHeaders([
        'key' => env('RAJAONGKIR_API_KEY'),
    ])->get('https://api.rajaongkir.com/starter/city');

    $cities = $response->json();

    return view('checkout.index', compact('cart', 'totalWeight', 'cities'));
}

    public function cekOngkir(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'destination_id' => 'required|integer',
            'courier' => 'required|string',
        ]);

        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->get('https://api.rajaongkir.com/starter/city');
        
        $cities = $response->json();

        // Ambil data keranjang dari session
        $cart = session('cart', []);

        // Hitung total berat produk dalam gram
        $totalWeight = 0;

        foreach ($cart as $item) {
            // Anda perlu menambahkan kolom berat_produk di tabel produk untuk menyimpan berat (gram)
            $productWeight = $item['berat_produk'] ?? 0; // Ambil berat dari keranjang
            $totalWeight += $productWeight * $item['jumlah']; // Berat x jumlah produk
        }

        if ($totalWeight === 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong atau tidak memiliki informasi berat.');
        }
    
        try {
            // Request ke API RajaOngkir
            $response = Http::withHeaders([
                'key' => env('RAJAONGKIR_API_KEY'),
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => '148', 
                'destination' => $request->destination_id, 
                'weight' => $request->weight, 
                'courier' => $request->courier,
            ]);
    
            $results = $response->json();
            
            session(['results' => $results, 'totalWeight' => $totalWeight]);
            return redirect()->route('checkout.result');
    
        } catch (\Exception $e) {
            // Tangani error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghubungi API.');
        }
    }
    public function result()
    {
        // Ambil hasil dari sesi
        $results = session('results');

        if (!$results) {
            return redirect()->route('checkout.index')->with('error', 'Hasil cek ongkir tidak ditemukan.');
        }

        return view('checkout.result', compact('results'));
    }
    
    public function checkoutForm()
    {
        $payment = Payment::all();
        // Ambil hasil cek ongkir dari session
        $results = session('results');
        $cart = session('cart', []);

        // Hitung total harga produk
        $totalProductPrice = 0;
        foreach ($cart as $item) {
            $totalProductPrice += $item['harga_produk'] * $item['jumlah'];
        }

        return view('checkout.form', compact('results', 'totalProductPrice', 'payment'));
    }

    public function processCheckout(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
        'payment_method' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'courier' => 'required|string',
        'shipping_method' => 'required|numeric|min:0',
    ]);

    if (!Auth::check()) {
        return redirect()->route('login')->withErrors('Harap login sebelum melakukan checkout.');
    }

    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->withErrors('Keranjang belanja kosong.');
    }

    $totalProductPrice = 0;
    foreach ($cart as $item) {
        $totalProductPrice += $item['harga_produk'] * $item['jumlah'];
    }

    $shippingCost = (float) $request->shipping_method;
    $totalPrice = $totalProductPrice + $shippingCost;

    if ($request->hasFile('payment_method')) {
        $paymentMethod = $request->file('payment_method');
        $paymentPath = 'dashboard-template/payment_proofs/' . uniqid() . '.' . $paymentMethod->getClientOriginalExtension();
        $paymentMethod->move(public_path('dashboard-template/payment_proofs'), basename($paymentPath));
    } else {
        abort(400, 'Bukti pembayaran wajib diunggah.');
    }

    $order = new Order();
    $order->user_id = Auth::id();
    $order->name = $request->name;
    $order->phone = $request->phone;
    $order->address = $request->address;
    $order->payment_method = $paymentPath;
    $order->courier = $request->courier;
    $order->total_price = $totalPrice;
    $order->cart_items = json_encode($cart);
    $order->status = 'pending';
    $order->shipping_status = 'Belum dikirim';
    $order->save();

    session()->forget('cart');
    session()->forget('results');

    return redirect()->route('index')->with('success', 'Checkout berhasil! Terima kasih telah berbelanja.');;
}

}
