<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use App\Models\Business;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    private $photo;
    private $business;

    public function __construct(Photo $photo, Business $business){
        $this->photo = $photo;
        $this->business = $business;
    }

    public function store(Request $request, $business_id){
        // Validation...
        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $i => $photo) {
                if ($photo) {
                    // 画像をストレージに保存
                    $imagePath = $photo->store('images/businesses/photos', 'public');
                    
                    // 優先度の設定
                    $priority = $request->input("priorities.$i") ?? ($i + 1);
    
                    // データベースに保存
                    Photo::create([
                        'business_id' => $business_id,
                        'image' => '/' . $imagePath,
                        'priority' => $priority,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Photos uploaded successfully');
    }

    // update メソッドの実装
    public function update(Request $request, $business){
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $i => $photo) {
                if ($photo) {
                    // 画像をストレージに保存
                    $imagePath = $photo->store('images/businesses/photos', 'public');
                    
                    // 優先度の設定
                    $priority = $request->input("priorities.$i") ?? ($i + 1);
    
                    // データベースに保存
                    Photo::create([
                        'business_id' => $business->id,
                        'image' => '/' . $imagePath,
                        'priority' => $priority,
                    ]);
                }
            }
        }
        
        return true;
    }

    public function edit($business_id){
        $photos = $this->photo->where('business_id', $business_id)->orderBy('priority')->get();
        $business = $this->business->findOrFail($business_id);
        
        return view('businessusers.posts.businesses.photos.edit')
            ->with('photos', $photos)
            ->with('business', $business);
    }

    public function destroy($id){
        $photo = $this->photo->findOrFail($id);
        
        // 画像ファイルをストレージから削除
        if ($photo->image && !Str::startsWith($photo->image, 'data:')) {
            $imagePath = ltrim($photo->image, '/');
            Storage::disk('public')->delete($imagePath);
        }
        
        // データベースから削除
        $photo->delete();
        
        return redirect()->back()->with('success', 'Photo deleted successfully');
    }
}