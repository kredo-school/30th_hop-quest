<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business; // Businessモデルをインポート

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('businessusers.profiles.posts');
    }

    public function followers()
    {
        return view('businessusers.profiles.followers');
    }

    public function edit()
    {
        $$business = Business::where('user_id', auth()->id())->first();

        if (!$business) {
            $business = new Business(); // 空のBusinessオブジェクトを生成
        }
    
        return view('businesses.edit', compact('business'));
    }
    
    public function reviews()
    {
        return view('businessusers.reviews.allreviews');
    }

    public function showreview()
    {
        return view('businessusers.reviews.showreview');
    }

    public function promotion_create()
    {
        return view('businessusers.posts.promotions.create');
    }

    public function promotion_edit()
    {
        return view('businessusers.posts.promotions.edit');
    }

    public function promotion_check()
    {
        return view('businessusers.posts.promotions.check');
    }

    public function promotion_show()
    {
        return view('businessusers.posts.promotions.show');
    }

    // Posts
    public function posts_followings()
    {
        return view('tourists.posts.followings');
    }

    public function posts_quests()
    {
        return view('tourists.posts.quests');
    }

    public function posts_spots()
    {
        return view('tourists.posts.spots');
    }

    public function posts_locations()
    {
        return view('tourists.posts.locations');
    }

    public function posts_events()
    {
        return view('tourists.posts.events');
    }
}