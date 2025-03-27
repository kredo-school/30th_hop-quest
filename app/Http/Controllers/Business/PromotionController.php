<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Business;
use App\Models\Promotion;

class PromotionController extends Controller
{
    private $promotion;
    private $business;
    private $user;

    public function __construct(Promotion $promotion, Business $business, User $user){
        $this->promotion = $promotion;
        $this->business = $business;
        $this->user = $user;
    }

    public function create(){
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.posts.promotions.create')->with('all_businesses',$all_businesses);
    }

    public function store(Request $request){
        //validation
        $request->validate([
            'title' => 'required',
            'business_id' => 'required',
            'introduction' => 'required|max:2000',
            'image' => 'required|max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        $this->promotion->title = $request->title;
        $this->promotion->introduction = $request->introduction;
        $this->promotion->promotion_start = $request->promotion_start;
        $this->promotion->promotion_end = $request->promotion_end;
        $this->promotion->display_start = $request->display_start;
        $this->promotion->display_end = $request->display_end;
        $this->promotion->business_id = $request->business_id;
        $this->promotion->user_id = Auth::user()->id;
        $this->promotion->image = "data:photo/".$request->image->extension().";base64,".base64_encode (file_get_contents($request->image)); 

        $this->promotion->save();

        $all_promotions = $this->promotion->where('user_id', Auth::user()->id)->latest()->get();
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return redirect()->route('profile.promotions', $this->promotion->business->user->id)->with('all_promotions', $all_promotions)->with('all_businesses', $all_businesses);
    }

    public function edit($id){
        $promotion_a = $this->promotion->findOrFail($id);
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.posts.promotions.edit')->with('promotion', $promotion_a)->with('all_businesses', $all_businesses);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'business_id' => 'required',
            'introduction' => 'required|max:2000',
            'image' => 'max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        $all_promotions = $this->promotion->where('user_id', Auth::user()->id)->latest()->get();
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();

        $promotion_a = $this->promotion->findOrFail($id);
        $promotion_a->title = $request->title;
        $promotion_a->introduction = $request->introduction;
        $promotion_a->promotion_start = $request->promotion_start;
        $promotion_a->promotion_end = $request->promotion_end;
        $promotion_a->display_start = $request->display_start;
        $promotion_a->display_end = $request->display_end;
        $promotion_a->business_id = $request->business_id;
        $promotion_a->user_id = Auth::user()->id;

        if($request->image){
            $promotion_a->image = "data:photo/".$request->image->extension().";base64,".base64_encode(file_get_contents($request->image));
        }
        $promotion_a->save();

        //redirect to Show Post
        return redirect()->route('profile.promotions', Auth::user()->id)->with('all_promotions', $all_promotions)->with('all_businesses', $all_businesses);
    }

    public function show($id){
        //get the data of 1 post where ID = $id
        $promotion_a = $this->promotion->findOrFail($id);
        
        return view('businessusers.posts.promotions.show')->with('promotion', $promotion_a);
    }

    public function deactivate($id){
        $this->promotion->destroy($id);
        return redirect()->back();
    }

    public function activate($id){
        $this->promotion->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
