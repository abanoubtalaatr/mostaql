<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {

        if($request->freelancer_id  && $request->comment &&  $request->rating) {
            Rating::create([
                'freelancer_id' => $request->freelancer_id,
                'owner_id' => auth()->id(),
                'comment' => $request->comment,
                'rating' => $request->rating,
            ]);
        }
        return redirect()->back();
    }
}
