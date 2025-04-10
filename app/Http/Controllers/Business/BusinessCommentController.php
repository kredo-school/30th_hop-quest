<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessComment;
use App\Models\Spot;

class BusinessCommentController extends Controller
{
    private $business;
    private $business_comment;


    public function __construct(BusinessComment $business_comment, Business $business){
        $this->business_comment = $business_comment;
        $this->business = $business;
    }

    public function reviews($id){
        //get the data of 1 post where ID = $id
        $all_business_comments = $this->business_comment->latest()->paginate(10);
        $business_comment_a = $this->business_comment->findOrFail($id);
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.reviews.allreviews' ,compact('all_business_comments', 'all_businesses'))->with('business_comment', $business_comment_a);
    }

    public function showReview($id){
        $business_comment_a = $this->business_comment->findOrFail($id);
        return view('businessusers.reviews.showreview')->with('business_comment', $business_comment_a);
    }

    public function show(Request $request){
    $query = BusinessComment::query();

    if ($request->filled('business_id')) {
        $query->where('business_id', $request->business_id);
    }

    $business_comments = $query->with('businessRelation', 'userRelation')->latest()->paginate(10);
    $businesses = Business::all(); // Spot一覧取得

    return view('businessusers.reviews.indexreview', compact('business_comments', 'businesses'));
    }

    public function showIndex(Request $request){
        $query = BusinessComment::with('userRelation', 'businessRelation');

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
    
        $business_comments = $query->latest()->paginate(11);
        // 表示されているレビューに登場するユーザー一覧（重複なし）
        $from_users = BusinessComment::whereIn('id', $business_comments->pluck('id'))
            ->with('userRelation')
            ->get()
            ->pluck('userRelation')
            ->unique('id');
        $from_businesses = BusinessComment::whereIn('id', $business_comments->pluck('id'))
            ->with('businessRelation')
            ->get()
            ->pluck('businessRelation')
            ->unique('id');

        return view('businessusers.reviews.indexreview', compact('business_comments', 'from_users', 'from_businesses'));
    }

    public function deleteReview($id){
        $this->business_comment->destroy($id);
        return redirect()->back();
    }

    }




