<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total revenue from delivered orders
        // Example: $totalRevenue = Order::where('seller_id', $user->id)->where('status', 'Delivered')->sum('price');
        $totalRevenue = 0;

        // Total orders received
        // Example: $totalOrders = Order::where('seller_id', $user->id)->count();
        $totalOrders = 0;

        // Orders placed today
        // Example: $newOrdersToday = Order::where('seller_id', $user->id)->whereDate('created_at', today())->count();
        $newOrdersToday = 0;

        // Active listings
        $activeListings = Listing::where('user_id', $user->id)->where('status', 'active')->count();

        // Expired listings
        $expiredListings = Listing::where('user_id', $user->id)->where('status', 'expired')->count();

        // Items sold (orders with status Delivered)
        // Example: $itemsSold = Order::where('seller_id', $user->id)->where('status', 'Delivered')->count();
        $itemsSold = 0;

        // Pending orders awaiting dispatch
        // Example: $pendingOrders = Order::where('seller_id', $user->id)->where('status', 'Pending')->count();
        $pendingOrders = 0;

        // Monthly sales — 12 values Jan–Dec
        $monthlySales = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        // Top categories based on this user's listings
        $topCategories = [
            ['name' => 'Video Games',    'pct' => 0],
            ['name' => 'Clothing',       'pct' => 0],
            ['name' => 'Electronics',    'pct' => 0],
            ['name' => 'Sporting Goods', 'pct' => 0],
            ['name' => 'Pottery',        'pct' => 0],
        ];

        // Recent orders (last 5)
        // Example: $recentOrders = Order::where('seller_id', $user->id)->latest()->take(5)->get();
        $recentOrders = collect();

        return view('dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'newOrdersToday',
            'activeListings',
            'expiredListings',
            'itemsSold',
            'pendingOrders',
            'monthlySales',
            'topCategories',
            'recentOrders'
        ));
    }
}