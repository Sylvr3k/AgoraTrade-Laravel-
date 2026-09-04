<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Order::where('buyer_id', Auth::id())->latest()->get();
        return view('purchases', compact('purchases'));
    }
}