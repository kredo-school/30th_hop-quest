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
        return view('businessusers.posts.businesses.add_n')->with('all_businesses',$all_businesses);
    }

    public function store(Request $request){
        $request->validate([
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',        
            'introduction' => 'required_if:official_certification,2|max:1000',
            'phonenumber' => 'required_if:official_certification,2|max:20',
            'zip' => 'required_if:official_certification,2|max:7',
            'address_1' => 'required_if:official_certification,2|max:255'
        ], [
            'introduction.required_if' => 'Required for official certification badge',
            'phonenumber.required_if' => 'Required for official certification badge',
            'zip.required_if' => 'Required for official certification badge',
            'address_1.required_if' => 'Required for official certification badge',
        ]);

        $this->business->category_id = $request->category_id;
        $this->business->user_id = Auth::user()->id;
        $this->business->name = $request->name;
        $this->business->main_image = "data:image/".$request->main_image->extension().";base64,".base64_encode (file_get_contents($request->main_image));
        $this->business->email = $request->email;
        $this->business->zip = $request->zip;
        $this->business->term_start = $request->term_start;
        $this->business->term_end = $request->term_end;
        $this->business->introduction = $request->introduction;

        $current_cert = $this->business->official_certification;

        if ($current_cert == 3) {
            if ($request->has('official_certification')) {
                // チェックあり → 特別な認定を外して普通の認定に戻す
                $this->business->official_certification = 2;
            } else {
                // チェックなし → 認定全部外す
                $this->business->official_certification = 1;
            }
        } else {
            if ($request->has('official_certification')) {
                $this->business->official_certification = 2;
            } else {
                $this->business->official_certification = 1;
            }
        }

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

        // // BusinessDetailを作成（business_idは自動で入る）
        // $businessDetail = $this->business->businessDetails()->create([
        // ]);

        // // 各カテゴリごとに Details を保存
        // foreach ($request->input('details', []) as $category => $items) {
        //     foreach ($items as $itemName) {
        //         $businessDetail->details()->create([
        //             'category' => $category,
        //             'name' => $itemName,
        //         ]);
        //     }
        // }

        // // 営業時間の保存
        // $businessHours = $request->input('business_hours', []);

        // foreach ($businessHours as $day => $data) {
        //     $this->business->businessHours()->create([
        //         'day_of_week' => $day,
        //         'opening_time' => $data['opening_time'] ?? null,
        //         'closing_time' => $data['closing_time'] ?? null,
        //         'break_start' => $data['break_start'] ?? null,
        //         'break_end' => $data['break_end'] ?? null,
        //         'notice' => $data['notice'] ?? null,
        //         'is_closed' => isset($data['is_closed']), // チェックが入っているかどうかで判定
        //     ]);
        // }
        
    
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
            'introduction' => 'required_if:official_certification,2|max:1000',
            'phonenumber' => 'required_if:official_certification,2|max:20',
            'zip' => 'required_if:official_certification,2|max:7',
            'address_1' => 'required_if:official_certification,2|max:255'
        ], [
            'introduction.required_if' => 'Required for official certification badge',
            'phonenumber.required_if' => 'Required for official certification badge',
            'zip.required_if' => 'Required for official certification badge',
            'address_1.required_if' => 'Required for official certification badge',
        ]);

        $business_a = $this->business->findOrFail($id);

        $business_a->category_id = $request->category_id;
        $business_a->user_id = Auth::user()->id;
        $business_a->name = $request->name;
        $business_a->email = $request->email;
        $business_a->zip = $request->zip;
        $business_a->phonenumber = $request->phonenumber;
        $business_a->address_1 = $request->address_1;
        $business_a->term_start = $request->term_start;
        $business_a->term_end = $request->term_end;
        $business_a->introduction = $request->introduction;


        if($request->main_image){
            $business_a->main_image = "data:image/".$request->main_image->extension().";base64,".base64_encode(file_get_contents($request->main_image));
        }

        $current_cert = $business_a->official_certification;

        if ($current_cert == 3) {
            if ($request->has('official_certification')) {
                // チェックあり → 特別な認定を外して普通の認定に戻す
                $business_a->official_certification = 2;
            } else {
                // チェックなし → 認定全部外す
                $business_a->official_certification = 1;
            }
        } else {
            if ($request->has('official_certification')) {
                $business_a->official_certification = 2;
            } else {
                $business_a->official_certification = 1;
            }
        }

        $business_a->save();        
        
        if ($request->hasFile('photos')) {
            $photoController = app(PhotoController::class);
            $photoController->update($request, $business_a);
        }

        
    //     // 1. Businessの基本情報を更新
    //     $business_a->update([
    //     'name' => $request->input('name'),
    //     'description' => $request->input('description'),
    //     ]);
    //     $businessDetail = $business_a->businessDetails()->create([
    //         // 内容
    //     ]);
    // // 2. BusinessHoursを一旦削除してから再作成（曜日単位のユニーク制約がなければこれが簡単）
    // $business_a->businessHours()->delete();

    // $businessHours = $request->input('business_hours', []);

    // foreach ($businessHours as $day => $data) {
    //     $business_a->businessHours()->create([
    //         'day_of_week'   => $day,
    //         'opening_time'  => $data['opening_time'] ?? null,
    //         'closing_time'  => $data['closing_time'] ?? null,
    //         'break_start'   => $data['break_start'] ?? null,
    //         'break_end'     => $data['break_end'] ?? null,
    //         'notice'        => $data['notice'] ?? null,
    //         'is_closed'     => isset($data['is_closed']),
    //     ]);
    // }

    // $businessDetail = $business_a->businessDetails()->first();
    // if (!$businessDetail) {
    //     $businessDetail = $business_a->businessDetails()->create();
    // }
    
    // // 古い details を削除
    // $businessDetail->details()->delete();
    
    // // 新しい details を保存
    // foreach ($request->input('details', []) as $category => $items) {
    //     foreach ($items as $itemName) {
    //         $businessDetail->details()->create([
    //             'category' => $category,
    //             'name' => $itemName,
    //         ]);
    //     }
    // }

        
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
