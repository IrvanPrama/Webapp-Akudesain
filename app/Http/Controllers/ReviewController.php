<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review_create(Request $request)
    {
        Review::create([
            'name' => $request->name,
            'role' => $request->role,
            'avatar' => $request->avatar,
            'user_id' => $request->user_id,
            'review' => $request->review
        ]);
    }
}
