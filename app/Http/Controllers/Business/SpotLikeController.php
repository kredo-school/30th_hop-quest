<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SpotLike;
use App\Models\User;
use App\Models\Spot;

class SpotLikeController extends Controller
{
    private $spot_like;
    private $user;
    private $spot;

    public function __construct(SpotLike $spot_like, Spot $spot, User $user){
        $this->spot_like = $spot_like;
        $this->spot = $spot;
        $this->user = $user;
    }

    public function storeLike($spot_id){
        $this->spot_like->user_id = Auth::user()->id;
        $this->spot_like->spot_id = $spot_id; //post we are liking
        $this->spot_like->save();

        //go to previous page
        return redirect()->back();
    }

    public function deleteLike($spot_id){
        //delete()
        $this->spot_like->where('user_id', Auth::user()->id)
                    ->where('spot_id', $spot_id)
                    ->delete();

        return redirect()->back();
    }
}
