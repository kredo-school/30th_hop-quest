<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\Photo;
use App\Http\Controllers\Business\PhotoController;
use Illuminate\Support\Facades\DB;

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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $this->business->category_id = $request->category_id;
        $this->business->user_id = Auth::user()->id;
        $this->business->name = $request->name;
        $this->business->main_image = "data:image/".$request->main_image->extension().";base64,".base64_encode (file_get_contents($request->main_image));
        $this->business->email = $request->email;
        $this->business->official_certification = 1;
        $this->business->save();

        // PhotoController の store を呼び出して写真を保存
        if ($request->hasFile('images')) {
            app(PhotoController::class)->store($request, $this->business);
            }
        

        return redirect()->route('profile.businesses',Auth::user()->id)->with('success', 'Business created successfully!');
    }

    public function edit($id){
        $business_a = $this->business->findOrFail($id);
        return view('businessusers.posts.businesses.edit')->with('business', $business_a);
    }

    public function update(Request $request, $id){
        $request->validate([
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $business_a = $this->business->findOrFail($id);

        $business_a->category_id = $request->category_id;
        $business_a->user_id = Auth::user()->id;
        $business_a->name = $request->name;
        $business_a->email = $request->email;
        $business_a->official_certification = 1;
        $business_a->save();

        if($request->main_image){
            $business_a->main_image = "data:image/".$request->main_image->extension().";base64,".base64_encode(file_get_contents($request->main_image));
        }
        
        if ($request->hasFile('image')) {
            // PhotoController をインスタンス化
            $photoController = app(\App\Http\Controllers\Business\PhotoController::class);

            // 呼び出して結果を受け取る
            $response = $photoController->update($request, $business_a);          
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
