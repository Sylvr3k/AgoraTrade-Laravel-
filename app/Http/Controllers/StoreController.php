<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;
use App\Models\Order;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Listing::where('status', 'active')->with('user');

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sort
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
        }

        $listings = $query->get();

        // Categories for filter bar
        $categories = Listing::where('status', 'active')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();

        // Hero stats
        $totalListings = Listing::where('status', 'active')->count();
        $totalSellers  = Listing::where('status', 'active')->distinct('user_id')->count('user_id');

        return view('store', compact('listings', 'categories', 'totalListings', 'totalSellers'));
    }

    public function buy(Request $request)
    {
        $request->validate([
            'listing_id'   => 'required|exists:listings,id',
            'buyer_name'   => 'required|string|max:255',
            'buyer_email'  => 'required|email',
            'buyer_address'=> 'required|string',
        ]);

        $listing = Listing::findOrFail($request->listing_id);

        // Prevent buying your own listing
        if ($listing->user_id === Auth::id()) {
            return back()->with('error', 'You cannot buy your own listing.');
        }

        // Create the order
        Order::create([
            'listing_id'    => $listing->id,
            'buyer_id'      => Auth::id(),
            'seller_id'     => $listing->user_id,
            'item_name'     => $listing->title,
            'price'         => $listing->price,
            'buyer_name'    => $request->buyer_name,
            'buyer_email'   => $request->buyer_email,
            'buyer_address' => $request->buyer_address,
            'status'        => 'Pending',
        ]);

        // Mark listing as sold
        $listing->update(['status' => 'sold']);

        return redirect()->url('/purchases')->with('success', 'Order placed successfully!');
    }
}