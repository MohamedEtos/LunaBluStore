<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        Review::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::check() ? Auth::id() : null,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'name' => $request->name,
            'email' => $request->email,
            'is_approved' => false, // Default to pending approval
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully! It awaits approval.');
    }
}
