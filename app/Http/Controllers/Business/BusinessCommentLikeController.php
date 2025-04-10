<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessCommentLike;

class BusinessCommentLikeController extends Controller
{
    private $business_comment_like;
    
    public function __construct(BusinessCommentLike $business_comment_like){
        $this->business_comment_like -> $business_comment_like;
    }

    public function store($review_id){
        $this->business_comment_like->user_id = Auth::user()->id;
        $this->business_comment_like->post_id = $review_id; //post we are liking
        $this->business_comment_like->save();

        //go to previous page
        return redirect()->back();
    }

    public function delete($review_id){
        //delete()
        $this->business_review_like->where('user_id', Auth::user()->id)
                    ->where('review_id', $review_id)
                    ->delete();

        return redirect()->back();
    }
}
