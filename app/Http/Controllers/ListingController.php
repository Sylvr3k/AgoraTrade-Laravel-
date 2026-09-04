<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Listing;

class ListingController extends Controller
{
    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|string',
            'price'       => 'required|numeric|min:0',
            'condition'   => 'required|string',
            'location'    => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('listings', 'public');
        }

        Listing::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'price'       => $request->price,
            'condition'   => $request->condition,
            'location'    => $request->location,
            'image'       => $imagePath,
            'status'      => 'active',
        ]);

        return redirect()->route('listings.index')->with('success', 'Your listing has been posted!');
    }

    public function index()
    {
        $listings = Listing::where('user_id', Auth::id())->latest()->get();
        return view('listings.index', compact('listings'));
    }

    public function destroy($id)
    {
        $listing = Listing::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($listing->image) {
            Storage::disk('public')->delete($listing->image);
        }

        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Listing deleted.');
    }
}