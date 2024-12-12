<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        // Cari produk berdasarkan id_produk
        $product = Product::where('id_produk', $id)->firstOrFail();
    
        $cart = session()->get('cart', []);
    
        // Periksa apakah produk sudah ada di keranjang
        if (isset($cart[$id])) {
            $cart[$id]['jumlah'] += 1; // Tambah jumlah jika produk sudah ada
        } else {
            $cart[$id] = [
                'id_produk' => $product->id_produk,
                'nama_produk' => $product->nama_produk,
                'berat_produk' => $product->berat_produk, // Pastikan ini diambil dari database
                'harga_produk' => $product->harga_produk,
                'gambar_produk' => $product->gambar_produk,
                'jumlah' => 1,
            ];
        }
    
        // Simpan keranjang ke session
        session()->put('cart', $cart);
    
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
    

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:0',
        ]);

        $cart = session('cart', []);

        // Periksa apakah produk ada di keranjang
        if (isset($cart[$id])) {
            if ($validated['jumlah'] === 0) {
                unset($cart[$id]); // Hapus produk jika jumlah 0
            } else {
                $cart[$id]['jumlah'] = $validated['jumlah'];
            }

            session(['cart' => $cart]);
            return redirect()->back()->with('success', 'Jumlah produk berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    public function delete($id)
    {
        $cart = session('cart', []);

        // Periksa apakah produk ada di keranjang
        if (isset($cart[$id])) {
            unset($cart[$id]); // Hapus produk dari keranjang
            session(['cart' => $cart]);
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    public function clear()
    {
        session()->forget('cart'); // Kosongkan keranjang
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan.');
    }
}