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

    public function store($business_comment_id){
        $this->business_comment_like->user_id = Auth::user()->id;
        $this->business_comment_like->business_comment_id = $business_comment_id; //post we are liking
        $this->business_comment_like->save();

        //go to previous page
        return redirect()->back();
    }

    public function delete($business_comment_like_id){
        //delete()
        $this->business_comment_like->where('user_id', Auth::user()->id)
                    ->where('business_comment_like_id', $business_comment_like_id)
                    ->delete();

        return redirect()->back();
    }
}
