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
        $business = new Business(); // ビュー内でのエラー防止のため追加
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.businesses.add', compact('business', 'all_businesses'));
    }

    public function store(Request $request){
        $request->validate([
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category_id' => 'required|integer',
            'status' => 'nullable|string|max:255',
            'term_start' => 'nullable|date',
            'term_end' => 'nullable|date',
            'introduction' => 'nullable|string',
            'sp_notes' => 'nullable|string',
            'address_1' => 'nullable|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'phonenumber' => 'nullable|string|max:20',
            'website_url' => 'nullable|url|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'x' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'identification_number' => 'nullable|string|max:255',
            'official_certification' => 'nullable|boolean',
            'display_start' => 'nullable|date',
            'display_end' => 'nullable|date',
        ]);

        // トランザクション開始
        DB::beginTransaction();
        
        try {
            // ビジネスデータの保存
            $this->business->category_id = $request->category_id;
            $this->business->user_id = Auth::user()->id;
            $this->business->name = $request->name;
            $this->business->main_image = "data:image/".$request->main_image->extension().";base64,".base64_encode(file_get_contents($request->main_image));
            $this->business->email = $request->email;
            $this->business->term_start = $request->term_start;
            $this->business->term_end = $request->term_end;
            $this->business->introduction = $request->introduction;
            $this->business->status = $request->status;
            $this->business->sp_notes = $request->sp_notes;
            $this->business->address_1 = $request->address_1;
            $this->business->address_2 = $request->address_2;
            $this->business->zip = $request->zip;
            $this->business->phonenumber = $request->phonenumber;
            $this->business->website_url = $request->website_url;
            $this->business->instagram = $request->instagram;
            $this->business->facebook = $request->facebook;
            $this->business->x = $request->x;
            $this->business->tiktok = $request->tiktok;
            $this->business->identification_number = $request->identification_number;
            $this->business->official_certification = $request->has('official_certification') ? 1 : 2;
            $this->business->display_start = $request->display_start;
            $this->business->display_end = $request->display_end;
            $this->business->save();

            // 写真の保存
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

            // BusinessDetailを作成
            $businessDetail = $this->business->businessDetails()->create();

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
                    'is_closed' => isset($data['is_closed']) ? 1 : 0, // 1=閉店, 0=営業中に修正
                ]);
            }
            
            DB::commit();
            return redirect()->route('profile.businesses', Auth::id())->with('success', 'ビジネスが正常に登録されました');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', '登録処理中にエラーが発生しました: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id){
        $business_a = $this->business->findOrFail($id);
        $businessHours = $business_a->businessHours->keyBy('day_of_week');
        $businessDetail = $business_a->businessDetails()->first();
        $checkedDetailItems = $businessDetail?->details->pluck('name')->toArray() ?? [];
        return view('businessusers.businesses.edit', compact('businessHours','checkedDetailItems'))->with('business', $business_a);
    }

    public function update(Request $request, $id){
        $request->validate([
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category_id' => 'required|integer',
        ]);

        DB::beginTransaction();
        
        try {
            $business_a = $this->business->findOrFail($id);

            // 基本情報の更新
            $business_a->category_id = $request->category_id;
            $business_a->name = $request->name;
            $business_a->email = $request->email;
            $business_a->term_start = $request->term_start;
            $business_a->term_end = $request->term_end;
            $business_a->introduction = $request->introduction;
            $business_a->status = $request->status;
            $business_a->sp_notes = $request->sp_notes;
            $business_a->address_1 = $request->address_1;
            $business_a->address_2 = $request->address_2;
            $business_a->zip = $request->zip;
            $business_a->phonenumber = $request->phonenumber;
            $business_a->website_url = $request->website_url;
            $business_a->instagram = $request->instagram;
            $business_a->facebook = $request->facebook;
            $business_a->x = $request->x;
            $business_a->tiktok = $request->tiktok;
            $business_a->identification_number = $request->identification_number;
            $business_a->official_certification = $request->has('official_certification') ? 1 : 2;
            $business_a->display_start = $request->display_start;
            $business_a->display_end = $request->display_end;

            // メイン画像の更新（アップロードがある場合のみ）
            if($request->hasFile('main_image')){
                $business_a->main_image = "data:image/".$request->main_image->extension().";base64,".base64_encode(file_get_contents($request->main_image));
            }

            $business_a->save();        
            
            // 写真の更新
            if ($request->hasFile('photos')) {
                $photoController = app(PhotoController::class);
                $photoController->update($request, $business_a);
            }
            
            // BusinessHoursを一旦削除してから再作成
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
                    'is_closed'     => isset($data['is_closed']) ? 1 : 0, // 1=閉店, 0=営業中に修正
                ]);
            }

            // BusinessDetailsの更新
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

            DB::commit();
            return redirect()->route('profile.businesses', Auth::id())->with('success', 'ビジネス情報が更新されました');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', '更新処理中にエラーが発生しました: ' . $e->getMessage())->withInput();
        }
    }


    public function show($id){
        //get the data of 1 post where ID = $id
        $business_a = $this->business->findOrFail($id);
        
        return view('businessusers.businesses.show')->with('business', $business_a);
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