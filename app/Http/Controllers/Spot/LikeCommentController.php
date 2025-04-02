<?php

namespace App\Http\Controllers\Spot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpotCommentLike;
use App\Models\SpotComment;
use Illuminate\Support\Facades\Auth;

class LikeCommentController extends Controller
{
    private $likeComment;
    private $comment;

    public function __construct(SpotCommentLike $likeComment, SpotComment $comment)
    {
        $this->likeComment = $likeComment;
        $this->comment = $comment;
        $this->middleware('auth');
    }

    public function like($comment_id)
    {
        $comment = $this->comment->findOrFail($comment_id);
        
        $comment->likes()->create([
            'user_id' => Auth::user()->id,
            'spot_comment_id' => $comment_id
        ]);

        return redirect()->back();
    }
    
    public function unlike($comment_id)
    {
        $comment = $this->comment->findOrFail($comment_id);

        $comment->likes()->where('user_id', Auth::user()->id)->delete();

        return redirect()->back();
    }
}