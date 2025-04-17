<?php

namespace App\Http\Controllers\Spot;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

    public function show($id)
    {
        // $spot = Spot::findOrFail($id);
        $spot = $this->spot->findOrFail($id);
        $user = $this->user->findOrFail($spot->user_id);

        // Convert storage path to URL
        $spot->main_image = Storage::url($spot->main_image);

        return view('spots.show')
            ->with('spot', $spot)
            ->with('user', $user);
    }

    public function create()
    {
        return view('spots.create');
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'title' => 'required',
            'introduction' => 'required',
            'main_image' => 'required|image|mimes:jpeg,jpg,png,gif|max:1048',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif|max:1048',
            'images' => 'array|max:6'
        ]);

        // Save image to storage/app/public
        $dir = 'images/spots';
        
        // save main image
        $main_image_name = time() . '_main_' . $request->file('main_image')->getClientOriginalName();
        $main_image_path = $request->file('main_image')->storeAs($dir, $main_image_name, 'public');
        
        // save additional images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $file_name = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs($dir, $file_name, 'public');
                $imagePaths[] = Storage::url($path);
            }
        }

        $this->spot->user_id      = Auth::user()->id;
        $this->spot->title        = $request->title;
        $this->spot->introduction = $request->introduction;
        $this->spot->main_image   = $main_image_path;
        $this->spot->geo_location = $request->geo_location;
        $this->spot->geo_lat      = $request->geo_lat;
        $this->spot->geo_lng      = $request->geo_lng;
        $this->spot->images       = json_encode($imagePaths);
        $this->spot->save();

        $spot = $this->spot->findOrFail($this->spot->id);

        return redirect()->route('spot.show', $spot->id);
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

