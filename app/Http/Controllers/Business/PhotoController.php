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
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
    
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $i => $photo) {
                if ($photo) {
                    $encoded = "data:image/" . $photo->extension() . ";base64," . base64_encode(file_get_contents($photo));
                    $priority = $request->input("priorities.$i") ?? ($i + 1);
                    $existing = $business->photos()->where('priority', $priority)->first();

                    if ($existing) {
                        $existing->update(['image' => $encoded]);
                    } else {
                        $business->photos()->create([
                            'image' => $encoded,
                            'priority' => $priority,
                        ]);
                    }
                }
            }
            return redirect()->back();
        }
    }

    
    public function update(Request $request, Business $business){
        $request->validate([
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
    
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $i => $photo) {
                if ($photo) {
                    $encoded = "data:image/" . $photo->extension() . ";base64," . base64_encode(file_get_contents($photo));
                    $priority = $request->input("priorities.$i") ?? ($i + 1);
    
                    $existing = $business->photos()->where('priority', $priority)->first();
    
                    if ($existing) {
                        $existing->update(['image' => $encoded]);
                    } else {
                        $business->photos()->create([
                            'image' => $encoded,
                            'priority' => $priority,
                        ]);
                    }
                }
            }
        }
        return redirect()->back();
}

public function edit(Business $business)
{
    $photos = $business->photos()->orderBy('priority')->get()->keyBy('priority');

    return view('businessusers.posts.businesses.edit_n', compact('business', 'photos'));
}

//     public function update(Request $request, Business $business){
//     $request->validate([
//         'images'   => 'nullable|array|max:3',
//         'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ]);

//     $photos = $request->file('images');

//     for ($i = 0; $i < 3; $i++) {
//         $uploaded = $photos[$i] ?? null;

//         // 既存の Photo を priority で取得
//         $existingPhoto = Photo::where('business_id', $business->id)
//                               ->where('priority', $i + 1)
//                               ->first();

//         if ($uploaded) {
//             $encoded = "data:photo/" . $uploaded->extension() . ";base64," . base64_encode(file_get_contents($uploaded));

//             if ($existingPhoto) {
//                 // 上書き保存
//                 $existingPhoto->image = $encoded;
//                 $existingPhoto->save();
//             } else {
//                 // 新しく作成
//                 Photo::create([
//                     'business_id' => $business->id,
//                     'image' => $encoded,
//                     'priority' => $i + 1,
//                 ]);
//             }
//         }
//         // 画像が未アップロードなら何もしない（既存画像を保持）
//     }
// }

    public function update(Request $request, Business $business)
{
    $request->validate([
        'images'   => 'nullable|array|max:3',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $photos = $request->file('images'); // images[0], images[1], images[2] が priority 1〜3 に対応

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