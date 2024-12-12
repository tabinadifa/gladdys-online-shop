<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahProduk = Product::count();
        $jumlahUser = User::where('usertype', 'user')->count();
        $jumlahAdmin = User::where('usertype', 'admin')->count();
        $jumlahPesanan = Order::count();
        $jumlahPesananPending = Order::where('status', 'pending')->count();
        $jumlahPesananProcess = Order::where('status', 'process')->count();
        $jumlahPesananDiterima = Order::where('status', 'delivered')->count();
        $jumlahPesananDitolak = Order::where('status', 'rejected')->count();
        return view('admin.dashboard', compact('jumlahProduk', 'jumlahUser', 'jumlahAdmin', 'jumlahPesanan', 'jumlahPesananPending', 'jumlahPesananProcess', 'jumlahPesananDiterima', 'jumlahPesananDitolak'));
    }
}
