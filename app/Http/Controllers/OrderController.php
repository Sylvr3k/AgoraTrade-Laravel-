<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;



class OrderController extends Controller
{
    public function index()
    {
        // Example: $orders = Order::where('seller_id', Auth::id())->latest()->get();
        $orders = Order::where('seller_id', Auth::id())->latest()->get(); $orders = collect();
        return view('orders', compact('orders'));

        
    }
}