<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string'],
        ]);

        $review = Review::create($validated);

        return response()->json($review, Response::HTTP_CREATED);
    }

    public function show(Review $review)
    {
        return $review;
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'customer_id' => ['sometimes', 'integer', 'exists:customers,id'],
            'rating' => ['sometimes', 'integer', 'min:1', 'max:5'],
            'comment' => ['sometimes', 'string'],
        ]);

        $review->update($validated);

        return $review;
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
