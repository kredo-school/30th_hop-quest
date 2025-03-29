<?php

namespace App\Http\Controllers\Spot;

use App\Models\Spot;
use App\Models\SpotLike;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    private $like;

    public function __construct(SpotLike $like)
    {
        $this->like = $like;
        $this->middleware('auth');
    }


    // store() - save the like / like a spot
    public function store($spot_id)
    {
        $spot = Spot::findOrFail($spot_id);
        
        try {
            $result = DB::table('spot_likes')->insert([
                'user_id' => Auth::user()->id, 
                'spot_id' => $spot_id
            ]);
            \Log::info('Direct DB insert result: ' . ($result ? 'success' : 'failure'));
        } catch (\Exception $e) {
            \Log::error('Error direct insert: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    // destroy() - delete the like / unlike a spot
    public function destroy($spot_id)
    {
        $spot = Spot::findOrFail($spot_id);
        
        $this->like
            ->where('user_id', Auth::user()->id)
            ->where('spot_id', $spot_id)
            ->delete();

        return redirect()->back();
    }
}