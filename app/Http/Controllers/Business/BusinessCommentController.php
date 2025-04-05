<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessComment;
use App\Models\Spot;

class ReviewController extends Controller
{
    private $business;
    private $business_comment;


    public function __construct(BusinessComment $business_comment, Business $business){
        $this->business_comment = $business_comment;
        $this->business = $business;
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

        if ($request->filled('sort_date')) {
            if ($request->sort_date === 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort_date === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        } else {
            // デフォルトは新しい順
            $query->orderBy('created_at', 'desc');
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
