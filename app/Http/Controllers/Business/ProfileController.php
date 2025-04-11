<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business;
use App\Models\Promotion;
use App\Models\Quest;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private $user;
    private $business;
    private $promotion;
    private $quest;

    public function __construct(User $user, Business $business, Promotion $promotion, Quest $quest){
        $this->user = $user;
        $this->business = $business;
        $this->promotion = $promotion;
        $this->quest = $quest;
    }

    public function edit($id){
        return view('businessusers.profiles.edit');
    }

    public function update(Request $request){
    $request->validate([
        'avatar' => 'max:1048|mimes:jpeg,jpg,png,gif',
        'header' => 'max:1048|mimes:jpeg,jpg,png,gif',
        'name' =>'required|max:50|unique:users,name,'.Auth::user()->id,
        'email' => 'required|max:50|email',
        //UPDATING: unique:<table>,<column>,<id of updated row>
        // CREATING: unique:<table>,<column>
        'introduction' => 'required_if:official_certification,2|max:1000',
        'phonenumber' => 'required_if:official_certification,2|max:20',
        'zip' => 'required_if:official_certification,2|max:7',
        'address' => 'required_if:official_certification,2|max:255'
    ], [
        'introduction.required_if' => 'Required for official certification badge',
        'phonenumber.required_if' => 'Required for official certification badge',
        'zip.required_if' => 'Required for official certification badge',
        'address.required_if' => 'Required for official certification badge',
    ]);
    $user_a = $this->user->findOrFail(Auth::user()->id);

    $user_a->name = $request->name;
    $user_a->email = $request->email;
    $user_a->introduction = $request->introduction;
    $user_a->website_url = $request->website_url;
    $user_a->zip = $request->zip;
    $user_a->address = $request->address;
    $user_a->phonenumber = $request->phonenumber;
    $user_a->instagram = $request->instagram;
    $user_a->facebook = $request->facebook;
    $user_a->x = $request->x;
    $user_a->tiktok = $request->tiktok;

    if($request->header){
        $user_a->header = "data:image/".$request->header->extension().";base64,".base64_encode(file_get_contents($request->header));
    }
    if($request->avatar){
        $user_a->avatar = "data:image/".$request->avatar->extension().";base64,".base64_encode(file_get_contents($request->avatar));
    }

    $current_cert = $user_a->official_certification;

    if ($current_cert == 3) {
        if ($request->has('official_certification')) {
            // チェックあり → 特別な認定を外して普通の認定に戻す
            $user_a->official_certification = 2;
        } else {
            // チェックなし → 認定全部外す
            $user_a->official_certification = 1;
        }
    } else {
        if ($request->has('official_certification')) {
            $user_a->official_certification = 2;
        } else {
            $user_a->official_certification = 1;
        }
    }

    $user_a->save();

    return redirect()->route('profile.businesses',Auth::user()->id);

    }

    public function showPromotions($id){
        //get data of 1 user
        $user_a = $this->user->findOrFail($id);
        $all_businesses = $this->business->withTrashed()->where('user_id', $user_a->id)->latest()->get();
        $all_promotions = $this->promotion->withTrashed()->where('user_id', $user_a->id)->latest()->paginate(3);
        return view('businessusers.profiles.promotions')->with('user', $user_a)->with('all_businesses', $all_businesses)->with('all_promotions', $all_promotions);
    }

    public function showBusinesses($id){
        $user_a = $this->user->findOrFail($id);
        // $user_a->load(['businesses.photos' => function ($query) {
        //     $query->orderBy('priority', 'asc')->limit(1);
        // }]);
        $all_businesses = $this->business->withTrashed()->with('topPhoto')->where('user_id', $user_a->id)->latest()->paginate(3);
        return view('businessusers.profiles.businesses')->with('user', $user_a)->with('all_businesses', $all_businesses);
    }

    public function showModelQuests($id){
        $user_a = $this->user->findOrFail($id);
        $all_quests = $this->quest->withTrashed()->where('user_id', $user_a->id)->latest()->paginate(3);
        return view('businessusers.profiles.modelquests')->with('user', $user_a)->with('all_quests', $all_quests);
    }

    public function followers($id){
    $user_a = $this->user->findOrFail($id);
    return view('businessusers.profiles.followers')->with('user', $user_a);
    }

    public function allReviews(Request $request, $id){
        $user = Auth::user();
        $user_a = $this->user->findOrFail($id);
    
        // ログインユーザーが登録しているBusiness一覧
        // $all_businesses = Business::where('user_id', Auth::user()->id)->get();
    
        // 絞り込み（GETパラメータにbusiness_idがある場合）
        $query = BusinessComment::with('userRelation', 'businessRelation');
    
        if ($request->filled('business_id')) {
            $query->where('business_id', $request->business_id);
        }  
        
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
    
        if ($request->filled('min_rating')) {
            $query->where('rating', '>=', $request->min_rating);
        }
    
        if ($request->filled('sort_date')) {
            if ($request->sort_date === 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort_date === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        } else {
            // デフォルトは新しい順
            $query->orderBy('created_at', 'desc');
        }
    
        $business_comments = $query->latest()->paginate(11);
        // 表示されているレビューに登場するユーザー一覧（重複なし）
        $from_users = BusinessComment::whereIn('id', $business_comments->pluck('id'))
            ->with('userRelation')
            ->get()
            ->pluck('userRelation')
            ->unique('id');
        $from_businesses = BusinessComment::whereIn('id', $business_comments->pluck('id'))
            ->with('businessRelation')
            ->get()
            ->pluck('businessRelation')
            ->unique('id');
    
        return view('businessusers.reviews.allreviews', compact('business_comments', 'from_businesses', 'from_users'))->with('user', $user_a);
    }


    public function deactivate($id){
        $user = User::findOrFail($id);
        $user->delete();
    
        Auth::logout(); // セッションからログアウト
        request()->session()->invalidate(); // セッション無効化
        request()->session()->regenerateToken(); // CSRFトークン再生成
    
        return redirect()->route('home'); // ゲストのトップページにリダイレクト
    }
    // public function deactivate($id){
    //     $this->business->destroy($id);
    //     return view('register.tourist');
    // }
    
}
