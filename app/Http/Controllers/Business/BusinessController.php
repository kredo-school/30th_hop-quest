<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessDetail;
use App\Models\BusinessComment;
use App\Models\BusinessInfoCategory;
use App\Models\BusinessHour;
use App\Models\Photo;
use App\Models\BusinessPromotion;
use App\Http\Controllers\Business\PhotoController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    private $user;
    private $business;
    private $business_promotion;
    private $business_hour;
    private $photo;
    private $businessDetail;
    private $business_info_category;

    public function __construct(Photo $photo, Business $business, User $user, 
        BusinessPromotion $business_promotion, BusinessHour $business_hour, BusinessInfoCategory $business_info_category)
    {
        $this->user = $user;
        $this->photo = $photo;
        $this->business = $business;
        $this->business_promotion = $business_promotion;
        $this->business_hour = $business_hour;
        $this->business_info_category = $business_info_category;
    }

    public function create(){
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        $business_info_category = BusinessInfoCategory::with('businessInfos')->get();
        
        return view('businessusers.posts.businesses.add')
            ->with('all_businesses', $all_businesses)
            ->with('business_info_category', $business_info_category);
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
        
        // main_imageがある場合のみ処理
        if ($request->hasFile('main_image')) {
            // 画像をストレージに保存
            $imagePath = $request->file('main_image')->store('images/businesses', 'public');
            $this->business->main_image = '/' . $imagePath;
        } else {
            // デフォルト画像を設定するか、nullのままにする
            $this->business->main_image = null;
        }
        
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
        $this->business->display_start = $request->display_start;
        $this->business->display_end = $request->display_end;

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
                    // 画像をストレージに保存
                    $imagePath = $photo->store('images/businesses/photos', 'public');
                    $priority = $request->input("priorities.$i") ?? ($i + 1);
    
                    Photo::create([
                        'business_id' => $this->business->id,
                        'image' => '/' . $imagePath,
                        'priority' => $priority,
                    ]);
                }
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

        // Business details の保存
        if ($request->has('business_info')) {
            foreach ($request->business_info as $infoId) {
                BusinessDetail::create([
                    'business_id' => $this->business->id,
                    'business_info_id' => $infoId,
                    'is_valid' => true
                ]);
            }
        }
    
        return redirect()->route('profile.header', Auth::id());
    }

    public function edit($id){
        $business_a = $this->business->findOrFail($id);
        $businessHours = $business_a->businessHours->keyBy('day_of_week');
        $businessDetail = $business_a->businessDetails;
        $business_info_category = BusinessInfoCategory::with('businessInfos')->get();
        
        return view('businessusers.posts.businesses.edit')
            ->with('business', $business_a)
            ->with('businessHours', $businessHours)
            ->with('business_info_category', $business_info_category);
    }

    public function update(Request $request, $id){
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

        $business_a = $this->business->findOrFail($id);

        $business_a->category_id = $request->category_id;
        $business_a->user_id = Auth::user()->id;
        $business_a->name = $request->name;
        
        // main_imageがある場合のみ処理
        if ($request->hasFile('main_image')) {
            // 既存の画像があれば削除（オプション）
            if ($business_a->main_image && !Str::startsWith($business_a->main_image, 'data:')) {
                $oldPath = ltrim($business_a->main_image, '/');
                Storage::disk('public')->delete($oldPath);
            }
            
            // 新しい画像を保存
            $imagePath = $request->file('main_image')->store('images/businesses', 'public');
            $business_a->main_image = '/' . $imagePath;
        } else {
            // デフォルト画像を設定するか、nullのままにする
            $business_a->main_image = null;
        }
        
        $business_a->email = $request->email;
        $business_a->zip = $request->zip;
        $business_a->phonenumber = $request->phonenumber;
        $business_a->address_1 = $request->address_1;
        $business_a->term_start = $request->term_start;
        $business_a->term_end = $request->term_end;
        $business_a->introduction = $request->introduction;

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
        
        // 既存のBusinessDetailsを削除
        BusinessDetail::where('business_id', $id)->delete();
        
        // 新しいBusinessDetailsを保存
        if ($request->has('business_info')) {
            foreach ($request->business_info as $infoId) {
                BusinessDetail::create([
                    'business_id' => $id,
                    'business_info_id' => $infoId,
                    'is_valid' => true
                ]);
            }
        }
        
        return redirect()->route('profile.header',Auth::user()->id);
    }

    public function show($id)
    {
        try {
            $business = $this->business->findOrFail($id);
            $business_promotion = BusinessPromotion::where('business_id', $id)->get();
            $business_hour = $this->business_hour->where('business_id', $id)->get();
            $business_info_category = BusinessInfoCategory::with(['businessInfos' => function($query) use ($id) {
                $query->with(['businessDetails' => function($query) use ($id) {
                    $query->where('business_id', $id);
                }]);
            }])->get();
            $business_comments = BusinessComment::with(['user', 'BusinessCommentlikes'])
            ->where('business_id', $id)
            ->latest() // created_at の新しい順
            ->paginate(5); // 5件ずつ

            return view('businessusers.posts.businesses.show')
                    ->with('business', $business)
                    ->with('business_hour', $business_hour)
                    ->with('business_comments', $business_comments)
                    ->with('business_info_category', $business_info_category)
                    ->with('business_promotion', $business_promotion);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('businesses.show', $id)->with('error', 'ビジネス情報が見つかりませんでした。');
        }
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
