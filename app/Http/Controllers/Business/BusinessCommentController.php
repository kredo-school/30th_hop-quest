<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessComment;

class BusinessCommentController extends Controller
{
    private $user;
    private $business;
    private $business_comment;

    public function __construct(BusinessComment $business_comment, Business $business, User $user){
        $this->business_comment = $business_comment;
        $this->business = $business;
        $this->user = $user;
    }

    public function reviews($id){
        //get the data of 1 post where ID = $id
        $all_business_comments = $this->business_comment->latest()->paginate(10);
        $business_comment_a = $this->business_comment->findOrFail($id);
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.reviews.allreviews')->with('all_business_comments', $all_business_comments)->with('all_businesses',$all_businesses)->with('business_comment', $business_comment_a);
    }

    public function showReview($id){
        $business_comment_a = $this->business_comment->findOrFail($id);
        return view('businessusers.reviews.showreview')->with('review', $business_comment_a);
    }

}
