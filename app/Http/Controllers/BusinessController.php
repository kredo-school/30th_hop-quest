<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use App\Models\Photo; 
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    private $business;
    private $user;

    public function __construct(Business $business, User $user)
    {
        $this->business = $business;
        $this->user = $user;
    }

    /**
     * ビジネス登録フォームの表示
     */
    public function createBusiness()
    {
        return view('businesses.add');
    }

    public function edit()
    {
        return view('businesses.edit', compact('business'));
    }

    /**
     * ビジネス情報の保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'category_id'     => ['required', 'integer'],
            'address_1'         => ['nullable', 'string', 'max:255'],
            'phonenumber'     => ['nullable', 'string', 'max:20'],
            'email'           => ['required', 'email', 'max:255'],
            // 'website_url'    => ['nullable', 'url', 'max:255'],
            'introduction'    => ['nullable', 'string'],
            // 'photos.*'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ← 追加: 写真のバリデーション
        ]);

        // ビジネス情報の保存
        $this->business->name = $request->name;
        $this->business->email = $request->email;
        $this->business->category_id = $request->category_id;
        $this->business->official_certification = 1;
        // $this->promotion->introduction = $request->introduction;
        // $this->promotion->promotion_start = $request->promotion_start;
        // $this->promotion->promotion_end = $request->promotion_end;
        // $this->promotion->display_start = $request->display_start;
        // $this->promotion->display_end = $request->display_end;
        // $this->promotion->business_id = $request->business_id;
        $this->business->user_id = Auth::user()->id;
        // $this->promotion->photo = "data:photo/".$request->photo->extension().";base64,".base64_encode (file_get_contents($request->photo));
        $this->business->save();
        // $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return redirect()->route('profile', Auth::user()->id)->with('success', 'ビジネス情報が登録されました！');
    }

    // メソッドsave_official
    // public function saveOfficial(Request $request, $id)
    // {
    //     $business = Business::find($id);
    //     $business->update($request->all());

    //     return redirect()->route('profile.edit')->with('success', '公式認証バッジの申請が完了しました。');
    // }

    public function update(Request $request, $id)
{
    // バリデーションの追加
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        // 他の必要なフィールドのバリデーションルールを追加
    ]);
    
    // データ取得
    $business = Business::find($id);
    
    // データが存在するか確認
    if (!$business) {
        return redirect()->route('profile', Auth::user()->id)->with('error', 'ビジネス情報が見つかりません。');
    }
    
    // トランザクションを使用してデータの整合性を確保
    try {
        DB::beginTransaction();
        
        // データ更新
        $business->update($validatedData);
        
        // 変更をコミット
        DB::commit();
        
        return redirect()->route('profile')->with('success', 'ビジネス情報を正常に保存しました。');
    } catch (\Exception $e) {
        // エラー発生時はロールバック
        DB::rollBack();
        
        return redirect()->route('profile')->with('error', 'ビジネス情報の保存に失敗しました: ' . $e->getMessage());
    }

    // ===== 写真がアップロードされている場合、保存処理を実施 =====
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $key => $photo) {
            if ($photo) {
                // 画像を public/storage/photos に保存
                $photoPath = $photo->store('photos', 'public');
                // Photoテーブルにレコード作成
                Photo::create([
                    'business_id' => $this->business->id, // 保存されたビジネスのIDを関連付け
                    'photo'       => $photoPath,
                    'priority'    => $key + 1, // 例: 1st, 2nd, 3rd の写真として
                ]);
            }
        }
    }

}
}