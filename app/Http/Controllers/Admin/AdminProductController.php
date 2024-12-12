<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class AdminProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        $product = Product::all();
        return view('admin.products.index', compact('product'));
    }

    /**
     * Menampilkan form untuk menambahkan produk baru.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.products.create', compact('category'));
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
            // Validasi data
            $validated = $request->validate([
                'nama_produk' => 'required|string|max:255',
                'kategori_produk' => 'required|string|max:255',
                'berat_produk' => 'required|numeric',
                'deskripsi_produk' => 'nullable|string',
                'harga_produk' => 'required|numeric',
                'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validasi gambar
            ]);
        
            // Proses gambar jika ada
            if ($request->hasFile('gambar_produk')) {
                $image = $request->file('gambar_produk');
                
                // Tentukan path penyimpanan gambar di folder public
                $imagePath = 'dashboard-template/products_img/' . $image->getClientOriginalName();
                
                // Pindahkan gambar ke folder public
                $image->move(public_path('dashboard-template/products_img'), $image->getClientOriginalName());
        
                // Simpan nama gambar untuk disimpan di database
                $imageUrl = $imagePath;
            } else {
                $imageUrl = null;
            }
        
            // Simpan data produk ke database
            Product::create([
                'nama_produk' => $validated['nama_produk'],
                'kategori_produk' => $validated['kategori_produk'],
                'berat_produk' => $validated['berat_produk'],
                'deskripsi_produk' => $validated['deskripsi_produk'],
                'harga_produk' => $validated['harga_produk'],
                'gambar_produk' => $imageUrl, // Simpan path gambar
            ]);

            session()->flash('success', 'Produk berhasil ditambah!');
        
            // Redirect atau beri respon sesuai kebutuhan
            return redirect()->route('products.index');
        }
        
    public function show(Product $product) 
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit(Product $product)
    {
        $category = Category::all();
        // Kembalikan view edit dengan data produk
        return view('admin.products.edit', compact('product', 'category'));
    }

public function update(Request $request, Product $product)
{
    // Validasi data
    $validated = $request->validate([
        'nama_produk' => 'required|string|max:255',
        'kategori_produk' => 'required|string|max:255',
        'berat_produk' => 'required|numeric',
        'deskripsi_produk' => 'nullable|string',
        'harga_produk' => 'required|numeric',
        'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Proses gambar jika ada
    if ($request->hasFile('gambar_produk')) {
        // Hapus gambar lama jika ada
        if ($product->gambar_produk && file_exists(public_path($product->gambar_produk))) {
            unlink(public_path($product->gambar_produk));
        }

        // Simpan gambar baru
        $imagePath = $request->file('gambar_produk')->store('products_img', 'public');
        $imageUrl = 'storage/' . $imagePath;
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $imageUrl = $product->gambar_produk;
    }

    // Update data produk di database
    $product->update([
        'nama_produk' => $validated['nama_produk'],
        'kategori_produk' => $validated['kategori_produk'],
        'berat_produk' => $validated['berat_produk'],
        'deskripsi_produk' => $validated['deskripsi_produk'],
        'harga_produk' => $validated['harga_produk'],
        'gambar_produk' => $imageUrl,
    ]);

    // Set pesan sukses
    session()->flash('success', 'Produk berhasil diubah!');

    // Redirect ke halaman index produk
    return redirect()->route('products.index');
}



    /**
     * Menghapus produk dari database.
     */
    public function destroy(Product $product)
    {

        // Hapus gambar jika bukan gambar default
        if ($product->gambar_produk && file_exists(public_path($product->gambar_produk))) {
            unlink(public_path($product->gambar_produk));
        }

        // Hapus produk dari database
        $product->delete();

        session()->flash('success', 'Produk berhasil dihapus!');

        return redirect()->route('products.index');
    }
}
