<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\Business;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    private $business;
    private $photo;

    public function __construct(Photo $photo, Business $business){
        $this->photo = $photo;
        $this->business = $business;
    }

    public function store(Request $request, Business $business)
    {
        $request->validate([
            'images'   => 'required|array|max:3', 
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    $photos = $request->file('images');

    if (!$photos) return; // 写真がない場合は何もしない

    foreach ($photos as $index => $photo) {
        if ($photo){ // 最大3枚まで

            $newPhoto = new Photo();
            $newPhoto->image = "data:photo/" . $photo->extension() . ";base64," . base64_encode(file_get_contents($photo));
            $newPhoto->business_id = $business->id;
            $newPhoto->priority = $index + 1;
            $newPhoto->save();
        }
    }
    }

    public function update(Request $request, Business $business)
    {
        $request->validate([
            'images'   => 'required|array|max:3', 
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    $photos = $request->file('images');

    if (!$photos) return; // 写真がない場合は何もしない

    for ($i = 0; $i < 3; $i++) {
        $uploaded = $photos[$i] ?? null;

        // 既存の priority=$i+1 のPhotoを取得
        $existingPhoto = Photo::where('business_id', $business->id)
                              ->where('priority', $i + 1)
                              ->first();

        if ($uploaded) {
            // 新しい画像がアップロードされていれば、上書き
            $encoded = "data:photo/" . $uploaded->extension() . ";base64," . base64_encode(file_get_contents($uploaded));

            if ($existingPhoto) {
                $existingPhoto->image = $encoded;
                $existingPhoto->save(); // 上書き保存
            } else {
                // なければ新規作成
                Photo::create([
                    'business_id' => $business->id,
                    'image' => $encoded,
                    'priority' => $i + 1
                ]);
            }
        }
        // 何もアップロードされてなければ何もしない（保持）
    }

    return back()->with('success', '写真を更新しました。');
    }
}