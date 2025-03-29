<?php

namespace App\Http\Controllers\Spot;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Spot;
use App\Models\User;

class IndexController extends Controller
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
        // バリデーション
        $request->validate([
            'title' => 'required',
            'introduction' => 'required',
            'geo_lat' => 'required|numeric',
            'geo_lng' => 'required|numeric',
            'spot-images.*' => 'image|mimes:jpeg,jpg,png,gif|max:1048|required',  // 1MB以下

            // 他の必要なバリデーションルール
        ]);

        $imagePaths = [];
        
        // 最大6枚まで処理
        if ($request->hasFile('spot-images')) {
            foreach($request->file('spot-images') as $index => $image) {
                if ($index >= 6) break;  // 6枚を超えた場合は処理を終了
                
                // 画像を保存してパスを取得
                $path = $image->store('public/spots/images');
                $imagePaths[] = Storage::url($path);  // 保存したパスを配列に追加
            }
        }

        $spot = new Spot();
        // $spot->user_id = Auth::user()->id;
        $spot->user_id = 1;
        $spot->title = $request->title;
        $spot->main_image = 'images/spot/mtfuji.jpg';
        $spot->introduction = $request->introduction;
        $spot->geo_location = $request->geo_location;
        $spot->geo_lat = $request->geo_lat;
        $spot->geo_lng = $request->geo_lng;
        $spot->images = $imagePaths;
        $spot->save();

        return redirect()->route('spot.show', $spot->id)->with('success', 'スポットを作成しました');
    }

}
