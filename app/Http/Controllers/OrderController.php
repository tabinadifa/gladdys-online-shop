<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

    return view('order.index', compact('orders'));
}
}
