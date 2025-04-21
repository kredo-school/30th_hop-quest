<?php

namespace App\Http\Controllers\Spot;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        // $spot = Spot::findOrFail($id);
        $spot = $this->spot->findOrFail($id);
        $user = $this->user->findOrFail($spot->user_id);

        // Convert storage path to URL
        // $spot->main_image = Storage::url($spot->main_image);

        return view('spots.show')
            ->with('spot', $spot)
            ->with('user', $user);
    }

    public function create(){
        $spot = new Spot();
        $editData = session('spot_edit_data', []);

        foreach (['title', 'introduction', 'geo_location', 'geo_lat', 'geo_lng'] as $key) {
            if (isset($editData[$key])) {
                $spot->$key = $editData[$key];
            }
        }

        if (!empty($editData['main_image_path'])) {
            $spot->main_image = $editData['main_image_path'];
        }

        if (!empty($editData['existing_images']) || !empty($editData['image_paths'])) {
            $spot->images = json_encode(array_merge(
                $editData['existing_images'] ?? [],
                $editData['image_paths'] ?? []
            ));
        }

        return view('spots.create')->with('spot', $spot);
    }


    public function store(Request $request){
        if ($request->input('from_confirm') === 'true') {
            $data = session('spot_edit_data', []);

            $spot = new Spot();
            $spot->user_id = Auth::id();
            $spot->title = $data['title'];
            $spot->introduction = $data['introduction'];
            $spot->geo_lat = $data['geo_lat'];
            $spot->geo_lng = $data['geo_lng'];
            $spot->geo_location = $data['geo_location'];

            $dir = 'images/spots';

            // ---- main_image の移動 ----
            if (!empty($data['main_image_path'])) {
                $tempPath = str_replace('/storage/', '', $data['main_image_path']); // "temp/..."
                $filename = time() . '_main_' . basename($tempPath);
                $newPath = "$dir/$filename";
                Storage::disk('public')->move($tempPath, $newPath);
                $spot->main_image = $newPath;
            }

            // ---- 画像の移動 ----
            $finalImages = [];
            $existingImages = $data['existing_images'] ?? [];

            foreach ($existingImages as $img) {
                $finalImages[] = $img;
            }

            foreach ($data['image_paths'] ?? [] as $img) {
                $tempPath = str_replace('/storage/', '', $img);
                $filename = time() . '_' . basename($tempPath);
                $newPath = "$dir/$filename";
                Storage::disk('public')->move($tempPath, $newPath);
                $finalImages[] = Storage::url($newPath);
            }

            $spot->images = json_encode($finalImages);
            $spot->save();

            session()->forget(['spot_edit_data', 'spot_id', 'spot_mode']);

            return redirect()->route('spots.show', $spot->id);
        }

        // 通常の登録処理
        $request->validate([
            'title' => 'required',
            'introduction' => 'required',
            'main_image' => 'required|image|mimes:jpeg,jpg,png,gif|max:1048',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif|max:1048',
            'images' => 'array|max:6'
        ]);

        $dir = 'images/spots';

        $main_image_name = time() . '_main_' . $request->file('main_image')->getClientOriginalName();
        $main_image_path = $request->file('main_image')->storeAs($dir, $main_image_name, 'public');

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $file_name = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs($dir, $file_name, 'public');
                $imagePaths[] = Storage::url($path);
            }
        }

        $spot = new Spot();
        $spot->user_id = Auth::id();
        $spot->title = $request->title;
        $spot->introduction = $request->introduction;
        $spot->main_image = $main_image_path;
        $spot->geo_location = $request->geo_location;
        $spot->geo_lat = $request->geo_lat;
        $spot->geo_lng = $request->geo_lng;
        $spot->images = json_encode($imagePaths);
        $spot->save();

        return redirect()->route('spots.show', $spot->id);
    }



    public function showConfirm(Request $request, $id = null){

        if (!$request->isMethod('post')) {
            if ($id) {
                return redirect()->route('spots.edit', ['spot_id' => $id]);
            } else {
                return redirect()->route('spots.create');
            }
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'introduction' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1048',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1048',
            'geo_lat' => 'nullable',
            'geo_lng' => 'nullable',
            'geo_location' => 'nullable|string',
        ]);

        $sessionData = [];

        // テキスト系フィールド
        foreach (['title', 'introduction', 'geo_lat', 'geo_lng', 'geo_location'] as $key) {
            if (!is_null($request->input($key))) {
                $sessionData[$key] = $request->input($key);
            }
        }

        // main_image の保存
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImagePath = $mainImage->store('temp/main_images', 'public');
            $sessionData['main_image_path'] = Storage::url($mainImagePath);
        }

        // main_image の保存 or セッションの値を維持
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImagePath = $mainImage->store('temp/main_images', 'public');
            $sessionData['main_image_path'] = Storage::url($mainImagePath);
        } elseif (session()->has('spot_edit_data.main_image_path')) {
            // 新しいファイルがない時でも、セッションの値を引き継ぐ
            $sessionData['main_image_path'] = session('spot_edit_data.main_image_path');
        }

        // 新規画像の保存
        // dd($request->file('images'));
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('temp/images', 'public');
                $imagePaths[] = Storage::url($path);
            }
            $sessionData['image_paths'] = $imagePaths;
        }

        // 既存画像（削除されていないもの）
        if ($request->filled('existing_images')) {
            $existing = $request->input('existing_images');
            $sessionData['existing_images'] = array_map(function ($img) {
                return Str::startsWith($img, '/storage') ? $img : Storage::url($img);
            }, $existing);
        }        

        $mode = $id ? 'update' : 'store';
        // dd($sessionData);
        session([
            'spot_edit_data' => $sessionData,
            'spot_id' => $id,
            'spot_mode' => $mode,
        ]);

        $spot = $id ? Spot::findOrFail($id) : new Spot();
        return view('spots.confirm-create', compact('spot'));
    }

    public function showEdit($id){    
        $spot = $this->spot->findOrFail($id);
        $user = $this->user->findOrFail($spot->user_id);

        if ($spot->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    
        $editData = session('spot_edit_data', []);
    
        // セッションの値で上書き（ある場合のみ）
        foreach (['title', 'introduction', 'geo_location', 'geo_lat', 'geo_lng'] as $key) {
            if (isset($editData[$key])) {
                $spot->$key = $editData[$key];
            }
        }
    
        if (!empty($editData['main_image_path'])) {
            $spot->main_image = $editData['main_image_path'];
        }
    
        if (!empty($editData['existing_images']) || !empty($editData['image_paths'])) {
            $spot->images = json_encode(array_merge(
                $editData['existing_images'] ?? [],
                $editData['image_paths'] ?? []
            ));
        }
    
        return view('spots.edit')
            ->with('spot', $spot)
            ->with('user', $user);
    }
    

    public function update(Request $request, $id){
        $spot = $this->spot->findOrFail($id);

        if ($request->input('from_confirm') === 'true') {
            // 確認画面からのリクエスト
            $data = session('spot_edit_data', []);

            $spot->title = $data['title'] ?? $spot->title;
            $spot->introduction = $data['introduction'] ?? $spot->introduction;
            $spot->geo_lat = $data['geo_lat'] ?? $spot->geo_lat;
            $spot->geo_lng = $data['geo_lng'] ?? $spot->geo_lng;
            $spot->geo_location = $data['geo_location'] ?? $spot->geo_location;

            if (!empty($data['main_image_path'])) {
                $tempPath = str_replace('/storage/', '', $data['main_image_path']); // "temp/main_images/xxx.jpg"
                if (Storage::disk('public')->exists($tempPath)) {
                    $fileName = time() . '_main_' . basename($tempPath);
                    $newPath = 'images/spots/' . $fileName;
            
                    // move to permanent location
                    Storage::disk('public')->move($tempPath, $newPath);
                    $spot->main_image = $newPath;
                }
            }

            $existingImages = $data['existing_images'] ?? json_decode($spot->images, true) ?? [];
            $newImages = $data['image_paths'] ?? [];
            $spot->images = json_encode(array_merge($existingImages, $newImages));

            $spot->save();

            session()->forget('spot_edit_data');
            session()->forget('spot_id');

            return redirect()->route('spots.show', $spot->id);
        }

        // 通常フォームからの更新（バリデーション含めて従来通り）
        $request->validate([
            'title' => 'required',
            'introduction' => 'required',
            'main_image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1048',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif|max:1048',
            'images' => 'array|max:6',
        ]);

        $dir = 'images/spots';

        if ($request->hasFile('main_image')) {
            $main_image_name = time() . '_main_' . $request->file('main_image')->getClientOriginalName();
            $main_image_path = $request->file('main_image')->storeAs($dir, $main_image_name, 'public');
            $spot->main_image = $main_image_path;
        }

        $newImagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $file_name = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs($dir, $file_name, 'public');
                $newImagePaths[] = Storage::url($path);
            }
        }

        $existingImages = $request->input('existing_images', []);
        $allImages = array_merge($existingImages, $newImagePaths);

        $spot->title = $request->title;
        $spot->introduction = $request->introduction;
        $spot->geo_location = $request->geo_location;
        $spot->geo_lat = $request->geo_lat;
        $spot->geo_lng = $request->geo_lng;
        $spot->images = json_encode($allImages);
        $spot->save();

        return redirect()->route('spots.show', $spot->id);
    }



}

