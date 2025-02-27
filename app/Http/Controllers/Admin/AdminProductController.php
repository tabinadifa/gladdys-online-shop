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
            'diskon' => 'nullable|numeric|min:0|max:1', // Diskon dalam bentuk desimal (0.1 = 10%)
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Proses gambar jika ada
        $imageUrl = null;
        if ($request->hasFile('gambar_produk')) {
            $image = $request->file('gambar_produk');
            $imagePath = 'dashboard-template/products_img/' . $image->getClientOriginalName();
            $image->move(base_path('dashboard-template/products_img'), $image->getClientOriginalName());
            $imageUrl = $imagePath;
        }

        // Hitung harga_final
        $diskon = $validated['diskon'] ?? 0;
        $harga_final = $validated['harga_produk'] - ($validated['harga_produk'] * $diskon);

        // Simpan data produk ke database
        Product::create([
            'nama_produk' => $validated['nama_produk'],
            'kategori_produk' => $validated['kategori_produk'],
            'berat_produk' => $validated['berat_produk'],
            'deskripsi_produk' => $validated['deskripsi_produk'],
            'harga_produk' => $validated['harga_produk'],
            'diskon' => $diskon,
            'harga_final' => $harga_final,
            'gambar_produk' => $imageUrl,
        ]);

        session()->flash('success', 'Produk berhasil ditambah!');

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
            'diskon' => 'nullable|numeric|min:0|max:1',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Proses gambar jika ada
        if ($request->hasFile('gambar_produk')) {
            if ($product->gambar_produk && file_exists(base_path($product->gambar_produk))) {
                unlink(base_path($product->gambar_produk));
            }
            $file = $request->file('gambar_produk');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Membuat nama unik
            $destinationPath = base_path('dashboard-template/img'); // Path folder tujuan
            $file->move($destinationPath, $fileName); // Memindahkan file
            $imageUrl = 'dashboard-template/img/' . $fileName; // Menyimpan path relatif
        } else {
            $imageUrl = $product->gambar_produk;
        }

        // Hitung harga_final
        $diskon = $validated['diskon'] ?? $product->diskon;
        $harga_final = $validated['harga_produk'] - ($validated['harga_produk'] * $diskon);

        // Update data produk di database
        $product->update([
            'nama_produk' => $validated['nama_produk'],
            'kategori_produk' => $validated['kategori_produk'],
            'berat_produk' => $validated['berat_produk'],
            'deskripsi_produk' => $validated['deskripsi_produk'],
            'harga_produk' => $validated['harga_produk'],
            'diskon' => $diskon,
            'harga_final' => $harga_final,
            'gambar_produk' => $imageUrl,
        ]);

        session()->flash('success', 'Produk berhasil diubah!');

        return redirect()->route('products.index');
    }

    /**
     * Menghapus produk dari database.
     */
    public function destroy(Product $product)
    {
        if ($product->gambar_produk && file_exists(base_path($product->gambar_produk))) {
            unlink(base_path($product->gambar_produk));
        }
        $product->delete();

        session()->flash('success', 'Produk berhasil dihapus!');

        return redirect()->route('products.index');
    }
}
