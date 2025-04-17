<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BusinessDetail;
use App\Models\Detail;
use App\Models\Photo;
use App\Models\BusinessHours;

class BusinessController extends Controller
{
    private $business;
    private $user;
    private $photo;

    public function __construct(Business $business, User $user, Photo $photo)
    {
        $this->business = $business;
        $this->user = $user;
        $this->photo = $photo;
    }

    //ビジネス登録フォームの表示
    public function createBusiness()
    {
        return view('businessusers.businesses.add');
    }

    public function edit($id)
    {
        $business_a = $this->business->findOrFail($id);
        return view('businessusers.businesses.edit')->with('business', $business_a);
    }

    /**
     * ビジネス情報の保存
     */

     public function store(Request $request){
        $request->validate([
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $this->business->category_id = $request->category_id;
        $this->business->user_id = Auth::user()->id;
        $this->business->name = $request->name;
        $this->business->main_image = "data:image/".$request->main_image->extension().";base64,".base64_encode (file_get_contents($request->main_image));
        $this->business->email = $request->email;
        $this->business->term_start = $request->term_start;
        $this->business->term_end = $request->term_end;
        $this->business->introduction = $request->introduction;
        $this->business->official_certification = 1;
        
        //  BusinessDetail作成
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

        // 保存された Business モデルを使うこと！
        $business = Business::create(array_merge(
            $validated,
            ['user_id' => Auth::id()]
        ));

        // BusinessHoursを dayごとに保存
        foreach ($request->input('business_hours', []) as $day => $values) {
            $business->businessHours()->create([
                'day_of_week'   => $day,
                'opening_time'  => $values['opening_time'] ?? null,
                'closing_time'  => $values['closing_time'] ?? null,
                'break_start'   => $values['break_start'] ?? null,
                'break_end'     => $values['break_end'] ?? null,
                'is_closed'     => isset($values['is_closed']) ? 1 : 0,
                'notice'        => $values['notice'] ?? null,
            ]);
        }

        
        // PhotoController の store を呼び出して写真を保存
        if ($request->hasFile('image')) {
            $uploaded = $request->file('image');
            $encoded = "data:photo/" . $uploaded->extension() . ";base64," . base64_encode(file_get_contents($uploaded));
            Photo::create([
                'business_id' => $this->business->id,
                'image' => $encoded,
                'priority' => 1,
            ]);
        }
        return redirect()->route('profile', Auth::id());
    }

    // ビジネス情報の更新
    public function update(Request $request, $id){
        $validated = $request->validate([
            'name'                   => 'required|string|max:255',
            'category_id'            => 'required|integer',
            'address_1'              => 'required_if:official_certification,1|string|max:255',
            'address_2'              => 'nullable|string|max:255',
            'phonenumber'            => 'required_if:official_certification,1|max:20',
            'email'                  => 'required|email|max:255',
            'introduction'           => 'nullable|string',
            'status'                 => 'nullable|string|max:100',
            'term_start'             => 'nullable|date',
            'term_end'               => 'nullable|date',
            'business_hours'         => 'nullable|integer',
            'sp_notes'               => 'nullable|string',
            'zip'                    => 'required_if:official_certification,1|max:20',
            'website_url'            => 'nullable|url|max:255',
            'instagram'              => 'nullable|string|max:255',
            'facebook'               => 'nullable|string|max:255',
            'x'                      => 'nullable|string|max:255',
            'tiktok'                 => 'nullable|string|max:255',
            'display_start'          => 'nullable|date',
            'display_end'            => 'nullable|date',
            'photos.*'               => 'nullable|image|max:2048',
        ]);

        $business = $this->business->find($id);

        if (!$business) {
            return redirect()->route('profile')->with('error', 'ビジネス情報が見つかりません。');
        }

        DB::beginTransaction();

        try {
            $business->update($validated);

            // 写真アップロード処理
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $index => $file) {
                    if ($file) {
                        $path = $file->store('business_photos', 'public');
                        Photo::create([
                            'business_id' => $business->id,
                            'image' => $path,
                            'priority' => $index + 1,
                        ]);
                    }
                }
            }

            // 既存の BusinessDetail を取得または作成
            $businessDetail = $this->business->businessDetails()->first();

            if ($businessDetail) {
                $businessDetail->details()->delete();
            } else {
                $businessDetail = $business->businessDetails()->create();
            }

            foreach ($request->input('details', []) as $category => $items) {
                foreach ($items as $itemName) {
                    $businessDetail->details()->create([
                        'category' => $category,
                        'name' => $itemName,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('business.edit', ['id' => $business->id])->with('success', 'ビジネス情報が更新されました。');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', '更新中にエラーが発生しました: ' . $e->getMessage());
        }
    }

    /**
     * 公認バッジ申請処理
     */
    public function saveOfficial(Request $request, $id)
    {
        $business = Business::find($id);
        $business->update($request->all());

        return redirect()->route('profile.edit')->with('success', 'Application for official HopQuest certification badge has been completed.');
    }
}
