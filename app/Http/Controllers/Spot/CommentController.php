<?php

namespace App\Http\Controllers\Spot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Spot;
use App\Models\SpotComment;
use App\Models\SpotCommentLike;

class CommentController extends Controller
{
    private $comment;

    public function __construct(SpotComment $comment)
    {
        $this->comment = $comment;
        $this->middleware('auth');
    }

    public function store(Request $request, $spot_id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $spot = Spot::findOrFail($spot_id);
        
        SpotComment::create([
            'user_id' => Auth::user()->id,
            'spot_id' => $spot_id,
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    
    public function destroy($spot_id, $comment_id)
    {
        $comment = $this->comment->findOrFail($comment_id);
                
        $this->comment->destroy($comment_id);
        
        return redirect()->back();
    }

    public function like($spot_id, $comment_id)
    {
        $comment = $this->comment->findOrFail($comment_id);
        
        $comment->likes()->create([
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back();
    }

    public function unlike($spot_id, $comment_id)
    {
        $comment = $this->comment->findOrFail($comment_id);

        $comment->likes()->where('user_id', Auth::user()->id)->delete();

        return redirect()->back();
    }
}

