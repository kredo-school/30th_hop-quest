<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\Review;
use App\Models\Spot;

class ReviewController extends Controller
{
    private $user;
    private $business;
    private $review;
    private $spot;

    public function __construct(Review $review, Business $business, User $user, Spot $spot){
        $this->review = $review;
        $this->business = $business;
        $this->user = $user;
        $this->spot = $spot;
    }

    public function reviews($id){
        //get the data of 1 post where ID = $id
        $all_reviews = $this->review->latest()->paginate(10);
        $review_a = $this->review->findOrFail($id);
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.reviews.allreviews')->with('all_reviews', $all_reviews)->with('all_businesses',$all_businesses)->with('review', $review_a);
    }

    public function showReview($id){
        $review_a = $this->review->findOrFail($id);
        return view('businessusers.reviews.showreview')->with('review', $review_a);
    }

    public function show(Request $request){
    $query = Review::query();

    if ($request->filled('business_id')) {
        $query->where('business_id', $request->business_id);
    }

    $reviews = $query->with('businessRelation', 'userRelation')->latest()->paginate(10);
    $businesses = Business::all(); // Spot一覧取得

    return view('businessusers.reviews.indexreview', compact('reviews', 'businesses'));
    }

    public function showIndex(Request $request){
        $query = Review::with('userRelation', 'businessRelation');

        if ($request->filled('business_id')) {
            $query->where('business_id', $request->business_id);
        }  
        
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

            // ★ ここで絞り込み（4以上など）
        if ($request->filled('min_rating')) {
            $query->where('rating', '>=', $request->min_rating);
        }
    
        $reviews = $query->latest()->paginate(10);
        // 表示されているレビューに登場するユーザー一覧（重複なし）
        $from_users = Review::whereIn('id', $reviews->pluck('id'))
            ->with('userRelation')
            ->get()
            ->pluck('userRelation')
            ->unique('id');
        $from_businesses = Review::whereIn('id', $reviews->pluck('id'))
            ->with('businessRelation')
            ->get()
            ->pluck('businessRelation')
            ->unique('id');

        return view('businessusers.reviews.indexreview', compact('reviews', 'from_users', 'from_businesses'));
    }



}
