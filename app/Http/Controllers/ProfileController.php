<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }

    public function posts($id){
        //get data of 1 user
        $user_a = $this->user->findOrFail($id);

        return view('businessusers.profiles.posts')->with('user', $user_a);
    }

    public function followers(){
        return view('businessusers.profiles.followers');
    }

    public function edit(){
        return view('businessusers.profiles.edit');
    }

    public function update(Request $request){
    $request->validate([
        'avatar' => 'max:1048|mimes:jpeg,jpg,png,gif',
        'header' => 'max:1048|mimes:jpeg,jpg,png,gif',
        'name' =>'required|max:50',
        'email' => 'required|max:50|email|unique:users,email,'.Auth::user()->id,
        //UPDATING: unique:<table>,<column>,<id of updated row>
        // CREATING: unique:<table>,<column>
        'introduction' => 'max:1000',
        'phonenumber' => 'required_if:official_certification,1|max:20',
        'zip' => 'required_if:official_certification,1|max:7',
        'address' => 'required_if:official_certification,1|max:255'
    ], [
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
    ;

    if($request->header){
        $user_a->header = "data:image/".$request->header->extension().";base64,".base64_encode(file_get_contents($request->header));
    }
    if($request->avatar){
        $user_a->avatar = "data:image/".$request->avatar->extension().";base64,".base64_encode(file_get_contents($request->avatar));
    }

    $user_a->save();

    return redirect()->route('profile.posts',Auth::user()->id);

    }

//     public function deleteAvatar(Request $request)
// {
//     $user = Auth::user();
//     $imageName = $request->input('image'); // 送信された画像名を取得

//     // ユーザーの現在の avatar が送られた画像名と一致しているか確認
//     if ($imageName && $user->avatar === $imageName) {
//         Storage::delete($imageName); // ストレージから削除
//         $user = User::find(Auth::user()->id);
//         $user->update(['avatar' => null]); // データベースの avatar を null に更新

//         return response()->json(['success' => true]);
//     }

//     return response()->json(['success' => false, 'message' => '画像の削除に失敗しました'], 400);
// }

    public function reviews(){
        return view('businessusers.reviews.allreviews');
    }

    public function showreview(){
        return view('businessusers.reviews.showreview');
    }


}
