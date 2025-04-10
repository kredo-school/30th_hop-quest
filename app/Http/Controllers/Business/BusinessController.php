<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessDetail;
use App\Models\BusinessHour;
use App\Models\Detail;
use App\Models\Photo;
use App\Http\Controllers\Business\PhotoController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    private $user;
    private $business;
    private $photo;

    public function __construct(Photo $photo, Business $business, User $user){
        $this->photo = $photo;
        $this->business = $business;
        $this->user = $user;
    }

    public function create(){
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.posts.businesses.add')->with('all_businesses',$all_businesses);
    }

    public function store(Request $request){
        $request->validate([
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $this->business->category_id = $request->category_id;
        $this->business->user_id = Auth::user()->id;
        $this->business->name = $request->name;
        $this->business->email = $request->email;
        $this->business->official_certification = 1;
        $this->business->save();

        // PhotoController の store を呼び出して写真を保存
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $i => $photo) {
                if ($photo) {
                    $encoded = "data:image/" . $photo->extension() . ";base64," . base64_encode(file_get_contents($photo));
                    $priority = $request->input("priorities.$i") ?? ($i + 1);
    
                    Photo::create([
                        'business_id' => $this->business->id,
                        'image' => $encoded,
                        'priority' => $priority,
                    ]);
                }
            }
        }

        // BusinessDetailを作成（business_idは自動で入る）
        $businessDetail = $this->business->businessDetails()->create([
        ]);

        // 各カテゴリごとに Details を保存
        foreach ($request->input('details', []) as $category => $items) {
            foreach ($items as $itemName) {
                $businessDetail->details()->create([
                    'category' => $category,
                    'name' => $itemName,
                ]);
            }
        }

        // 営業時間の保存
        $businessHours = $request->input('business_hours', []);

        foreach ($businessHours as $day => $data) {
            $this->business->businessHours()->create([
                'day_of_week' => $day,
                'opening_time' => $data['opening_time'] ?? null,
                'closing_time' => $data['closing_time'] ?? null,
                'break_start' => $data['break_start'] ?? null,
                'break_end' => $data['break_end'] ?? null,
                'notice' => $data['notice'] ?? null,
                'is_closed' => isset($data['is_closed']), // チェックが入っているかどうかで判定
            ]);
        }
        
    
        return redirect()->route('profile.businesses', Auth::id());
    }

    public function edit($id){
        $business_a = $this->business->findOrFail($id);
        $businessHours = $business_a->businessHours->keyBy('day_of_week');
        $businessDetail = $business_a->businessDetails()->first();
        $checkedDetailItems = $businessDetail?->details->pluck('name')->toArray() ?? [];
        return view('businessusers.posts.businesses.edit_n', compact('businessHours','checkedDetailItems'))->with('business', $business_a);
    }

    public function update(Request $request, $id){
        $request->validate([
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $business_a = $this->business->findOrFail($id);

        $business_a->category_id = $request->category_id;
        $business_a->user_id = Auth::user()->id;
        $business_a->name = $request->name;
        $business_a->email = $request->email;
        $business_a->official_certification = 1;


        if($request->main_image){
            $business_a->main_image = "data:image/".$request->main_image->extension().";base64,".base64_encode(file_get_contents($request->main_image));
        }

        $business_a->save();        
        
        if ($request->hasFile('photos')) {
            $photoController = app(PhotoController::class);
            $photoController->update($request, $business_a);
        }

        
        // 1. Businessの基本情報を更新
        $business_a->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        ]);
        $businessDetail = $business_a->businessDetails()->create([
            // 内容
        ]);
    // 2. BusinessHoursを一旦削除してから再作成（曜日単位のユニーク制約がなければこれが簡単）
    $business_a->businessHours()->delete();

    $businessHours = $request->input('business_hours', []);

    foreach ($businessHours as $day => $data) {
        $business_a->businessHours()->create([
            'day_of_week'   => $day,
            'opening_time'  => $data['opening_time'] ?? null,
            'closing_time'  => $data['closing_time'] ?? null,
            'break_start'   => $data['break_start'] ?? null,
            'break_end'     => $data['break_end'] ?? null,
            'notice'        => $data['notice'] ?? null,
            'is_closed'     => isset($data['is_closed']),
        ]);
    }

    $businessDetail = $business_a->businessDetails()->first();
    if (!$businessDetail) {
        $businessDetail = $business_a->businessDetails()->create();
    }
    
    // 古い details を削除
    $businessDetail->details()->delete();
    
    // 新しい details を保存
    foreach ($request->input('details', []) as $category => $items) {
        foreach ($items as $itemName) {
            $businessDetail->details()->create([
                'category' => $category,
                'name' => $itemName,
            ]);
        }
    }

        
        return redirect()->route('profile.businesses',Auth::user()->id);
    }


    public function show($id){
        //get the data of 1 post where ID = $id
        $business_a = $this->business->findOrFail($id);
        
        return view('businessusers.posts.businesses.show')->with('business', $business_a);
    }

    public function deactivate($id){
        $this->business->destroy($id);
        return redirect()->back();
    }

    public function activate($id){
        $this->business->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

}
