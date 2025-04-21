<?php

namespace App\Http\Controllers\Spot;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Spot;
use App\Models\User;

class SpotController extends Controller
{
    private $spot;
    private $user;

    public function __construct(Spot $spot, User $user)
    {
        $this->spot = $spot;
        $this->user = $user;
    }

    public function show($id)
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

    // destroy() - delete the like / unlike a spot
    public function destroy($spot_id)
    {
        $spot = Spot::findOrFail($spot_id);
        
        $this->like
            ->where('user_id', Auth::user()->id)
            ->where('spot_id', $spot_id)
            ->delete();

        // return redirect()->back();
        return response()->json(['status' => 'success']);

    }

    public function getLikesJson($spotId){
        $spot = Spot::with('likes.user')->findOrFail($spotId);
        $authUser = auth()->user();

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


}

