<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\Review;

class ReviewController extends Controller
{
    private $user;
    private $business;
    private $review;

    public function __construct(Review $review, Business $business, User $user){
        $this->review = $review;
        $this->business = $business;
        $this->user = $user;
    }

    public function reviews($id){
        //get the data of 1 post where ID = $id
        $all_reviews = $this->review->where('user_id', Auth::user()->id)->latest()->paginate(10);
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.reviews.allreviews')->with('all_reviews', $all_reviews);
    }

    public function showReview($id){
        $review_a = $this->review->findOrFail($id);
        return view('businessusers.reviews.showreview')->with('review', $review_a);
    }

}
