<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class AdminPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = Payment::all();
        return view('admin.payment.index', compact('payment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'gambar_qris' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('gambar_qris')) {
            $image = $request->file('gambar_qris');
            
            // Tentukan path penyimpanan gambar di folder public
            $imagePath = 'dashboard-template/qris_img/' . $image->getClientOriginalName();
            
            // Pindahkan gambar ke folder public
            $image->move(public_path('dashboard-template/qris_img'), $image->getClientOriginalName());
    
            // Simpan nama gambar untuk disimpan di database
            $imageUrl = $imagePath;
        } else {
            $imageUrl = null;
        }

        Payment::create([
            'gambar_qris' => $imageUrl,
        ]);

        session()->flash('success', 'Gambar QRIS berhasil ditambah!');

        return redirect()->route('payment.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return view('admin.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('admin.payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validate = $request->validate([
            'gambar_qris' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('gambar_qris')) {
            $image = $request->file('gambar_qris');
            
            // Tentukan path penyimpanan gambar di folder public
            $imagePath = 'dashboard-template/qris_img/' . $image->getClientOriginalName();
            
            // Pindahkan gambar ke folder public
            $image->move(public_path('dashboard-template/qris_img'), $image->getClientOriginalName());
    
            // Simpan nama gambar untuk disimpan di database
            $imageUrl = $imagePath;
        } else {
            $imageUrl = $payment->gambar_produk;
        }

        $payment->update([
            'gambar_qris' => $imageUrl,
        ]);

        session()->flash('success', 'Gambar QRIS berhasil diubah!');

        // Redirect ke halaman index produk
        return redirect()->route('payment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        if ($payment->gambar_qris && file_exists(public_path($payment->gambar_qris))) {
            unlink(public_path($payment->gambar_qris));
        }
    
        // Hapus produk dari database
        $payment->delete();

        session()->flash('success', 'Gambar QRIS berhasil dihapus!');

        return redirect()->route('payment.index');
    }
}
