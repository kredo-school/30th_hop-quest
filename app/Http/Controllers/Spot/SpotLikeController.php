<?php

namespace App\Http\Controllers\Spot;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Spot;
use App\Models\User;
use App\Models\SpotLike;

class SpotLikeController extends Controller

{
    private $spot;
    private $user;
    private $spot_like;

    public function __construct(Spot $spot, User $user, SpotLike $spot_like)
    {
        $this->spot = $spot;
        $this->user = $user;
        $this->spot_like = $spot_like;
    }

    public function show($spot_id)
    {
        $spot = Spot::findOrFail($spot_id);
        
        try {
            $result = DB::table('spot_likes')->insert([
                'user_id' => Auth::user()->id, 
                'spot_id' => $spot_id
            ]);
            // \Log::info('Direct DB insert result: ' . ($result ? 'success' : 'failure'));
        } catch (\Exception $e) {
            // \Log::error('Error direct insert: ' . $e->getMessage());
        }

        // return redirect()->back();
        return response()->json(['status' => 'success']);

    }

    public function getLikesJson($spotId){
        $spot = Spot::with('likes.user')->findOrFail($spotId);
        $authUser = Auth::user();

        $likes = $spot->likes->map(function ($like) use ($authUser) {
            $user = $like->user;
            return [
                'id' => $user->id,
                'name' => $user->name,
                'avatar' => $user->avatar,
                'is_own' => $authUser && $authUser->id === $user->id,
                'is_followed' => $authUser && $authUser->follows->contains('followed_id', $user->id),
            ];
        });

        return response()->json($likes);
    }

    public function getModalHtml($spot_id){
        $spot = Spot::with('likes.user')->findOrFail($spot_id);
        return view('spots.likes-modal', compact('spot'))->render();
    }

    public function storeSpotLike($spot_id){
        $this->spot_like->user_id = Auth::user()->id;
        $this->spot_like->spot_id = $spot_id; //post we are liking
        $this->spot_like->save();

        //go to previous page
        return redirect()->back();
    }

    public function deleteSpotLike($spot_id){
        //delete()
        $this->spot_like->where('user_id', Auth::user()->id)
                    ->where('spot_id', $spot_id)
                    ->delete();

        return redirect()->back();
    }
}

