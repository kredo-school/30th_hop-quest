<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business;
use App\Models\Promotion;
use App\Models\Quest;
use App\Models\Photo;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    private $user;
    private $business;
    private $promotion;
    private $quest;
    private $review;

    public function __construct(User $user, Business $business, Promotion $promotion, Quest $quest, Review $review){
        $this->user = $user;
        $this->business = $business;
        $this->promotion = $promotion;
        $this->quest = $quest;
        $this->review = $review;
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

    if($request->header){
        $user_a->header = "data:image/".$request->header->extension().";base64,".base64_encode(file_get_contents($request->header));
    }
    if($request->avatar){
        $user_a->avatar = "data:image/".$request->avatar->extension().";base64,".base64_encode(file_get_contents($request->avatar));
    }

    $user_a->save();

    return redirect()->route('profile.businesses',Auth::user()->id);

    }

    public function showPromotions($id){
        //get data of 1 user
        $user_a = $this->user->findOrFail($id);
        $all_businesses = $this->business->withTrashed()->where('user_id', $user_a->id)->latest()->get();
        $all_promotions = $this->promotion->withTrashed()->where('user_id', $user_a->id)->latest()->paginate(3);
        $reviews = DB::table('reviews')
        ->join('businesses', 'reviews.business_id', '=', 'businesses.id')
        ->where('businesses.user_id', $id)
        ->select('reviews.*') 
        ->get();
        return view('businessusers.profiles.promotions')->with('user', $user_a)->with('all_businesses', $all_businesses)->with('all_promotions', $all_promotions)->with('reviews', $reviews);
    }

    public function showBusinesses($id){
        $user_a = $this->user->findOrFail($id);
        $user_a->load(['businesses.photos' => function ($query) {
            $query->orderBy('priority', 'asc')->limit(1);
        }]);
        $all_businesses = $this->business->withTrashed()->with('topPhoto')->where('user_id', $user_a->id)->latest()->paginate(3);
        $reviews = DB::table('reviews')
            ->join('businesses', 'reviews.business_id', '=', 'businesses.id')
            ->where('businesses.user_id', $id)
            ->select('reviews.*') 
            ->get();
        return view('businessusers.profiles.businesses')->with('user', $user_a)->with('all_businesses', $all_businesses)->with('reviews', $reviews);
    }

    public function showModelQuests($id){
        $user_a = $this->user->findOrFail($id);
        $all_quests = $this->quest->withTrashed()->where('user_id', $user_a->id)->latest()->paginate(3);
        $all_businesses = $this->business->withTrashed()->where('user_id', $user_a->id)->latest()->get();
        $reviews = DB::table('reviews')
        ->join('businesses', 'reviews.business_id', '=', 'businesses.id')
        ->where('businesses.user_id', $id)
        ->select('reviews.*') 
        ->get();
        return view('businessusers.profiles.modelquests')->with('user', $user_a)->with('all_businesses', $all_businesses)->with('all_quests', $all_quests)->with('reviews',$reviews);
    }

    public function followers($id){
        $user_a = $this->user->findOrFail($id);
        $all_businesses = $this->business->withTrashed()->where('user_id', $user_a->id)->latest()->get();
        return view('businessusers.profiles.followers')->with('user', $user_a)->with('all_businesses', $all_businesses);
    }

    public function allReviews($id){
        $all_reviews = $this->review->latest()->paginate(10);
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.reviews.allreviews')->with('all_reviews', $all_reviews)->with('all_businesses',$all_businesses);
    }


}
