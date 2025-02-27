<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::all(); 
        return view('admin.orders.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
            // Validasi hanya status yang dapat diubah
    $validated = $request->validate([
        'status' => 'required|in:cancelled,pending,process,delivered',
    ]);

    // Update status pada order
    $order->update([
        'status' => $validated['status'],
    ]);

    return redirect()->route('orders.index')->with('success', 'Status order berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
         // Hapus data order
         $order->delete();

         return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
     
    }
}
