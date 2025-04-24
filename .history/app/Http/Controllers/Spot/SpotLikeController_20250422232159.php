<?php

namespace App\Http\Controllers\Spot;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function getLikesJson($spotId)
    {
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

    public function getModalHtml($spot_id)
    {
        $spot = Spot::with('likes.user')->findOrFail($spot_id);
        return view('spots.likes-modal', compact('spot'))->render();
    }
}
