<?php

namespace App\Http\Controllers\Spot;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\SpotLike;

use App\Models\Spot;
use App\Models\User;

class SpotLikeController extends Controller
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
        $spot = Spot::findOrFail($id);
        
        try {
            $result = DB::table('spot_likes')->insert([
                'user_id' => Auth::user()->id, 
                'spot_id' => $id
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
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'please login.'], 401);
        }
        $spot = Spot::findOrFail($spot_id);
        
        SpotLike::where('user_id', Auth::id())
            ->where('spot_id', $spot_id)
            ->delete();


        // return redirect()->back();
        return response()->json(['status' => 'success']);

    }

//     public function getLikesJson($spotId){
//     $spot = Spot::with('likes.user')->findOrFail($spotId);

//     /** @var \App\Models\User|null $authUser */
//     $authUser = auth()->user();

//     $likes = $spot->likes->map(function ($like) use ($authUser) {
//         $user = $like->user;

//         return [
//             'id' => $user->id,
//             'name' => $user->name,
//             'avatar' => $user->avatar,
//             'is_own' => $authUser && $authUser->id === $user->id,
//             'is_followed' => $authUser && $authUser->follows->contains('followed_id', $user->id),
//         ];
//     });

//     return response()->json($likes);
// }


    public function getModalHtml($spot_id){
        $spot = Spot::with('likes.user')->findOrFail($spot_id);
        return view('spots.likes-modal', compact('spot'))->render();
    }

    public function store($spot_id){
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Please login'], 401);
        }
        try {
            DB::table('spot_likes')->insert([
                'user_id' => Auth::id(),
                'spot_id' => $spot_id
            ]);  
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }

        return response()->json(['status' => 'success']);
    }


}

