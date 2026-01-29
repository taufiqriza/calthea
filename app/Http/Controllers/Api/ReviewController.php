<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Review::approved()->latest();

        // Filter featured only
        if ($request->boolean('featured')) {
            $query->featured();
        }

        $reviews = $query->get();

        return response()->json([
            'success' => true,
            'data' => $reviews,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $review = Review::create([
            ...$validated,
            'is_approved' => false, // Needs admin approval
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas review Anda! Review akan ditampilkan setelah disetujui.',
            'data' => $review,
        ], 201);
    }
}
