<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Oculo;
use App\Models\Review;
use App\Models\User;
use App\Models\Historial;

class ReviewController extends Controller
{
    function home(){
        $reviews = Review::all();
        $reviewsClone = clone $reviews;
        foreach ($reviewsClone as $review) {
            $user = User::find($review->user_id);
            $oculo = Historial::where('oculo_id', $review->oculo_id)->first();
            $review->autor = $user->name;
            $review->oculo = $oculo->marca . ' ' . $oculo->modelo;
        }
        return view('home', ['reviews' => $reviewsClone]);
    }

    function postReview(Request $request) {
        $request->validate([
            'rating' => 'required',
            'comment' => 'required'
        ]);

        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->oculo_id = request('id');
        $review->rating = request('rating');
        $review->comment = request('comment');
        $review->save();
        return redirect('/profile')->with('review', 'Review adicionada com sucesso!');
    }
}
