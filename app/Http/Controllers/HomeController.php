<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        return view('home');
    }

    
    public function promotion_create(){
        return view('businessusers.posts.promotions.create');
    }

    public function promotion_edit(){
        return view('businessusers.posts.promotions.edit');
    }

    public function promotion_check(){
        return view('businessusers.posts.promotions.check');
    }

    public function promotion_show(){
        return view('businessusers.posts.promotions.show');
    }

// Posts
    public function posts_followings(){
        return view('tourists.posts.followings');
    }
    public function posts_quests(){
        return view('tourists.posts.quests');
    }
    public function posts_spots(){
        return view('tourists.posts.spots');
    }
    public function posts_locations(){
        return view('tourists.posts.locations');
    }
    public function posts_events(){
        return view('tourists.posts.events');
    }

    // Search Result
    public function search(Request $request){

        $quests = $this->quest->where('title', 'like', '%' . $request->search . '%')
                            ->orWhere('introduction', 'like', '%' . $request->search . '%')->latest()->get();

        $spots  = $this->spot->where('title', 'like', '%' . $request->search . '%')
                            ->orWhere('introduction', 'like', '%' . $request->search . '%')->latest()->get();

        $business_locations = $this->business
            ->where('category_id', '1')
            ->where(function ($query) use ($request){
            $query->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('introduction', 'like', '%' . $request->search . '%');
            })->latest()->get();

        $business_events = $this->business
            ->where('category_id', '2')
            ->where(function ($query) use ($request){
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('introduction', 'like', '%' . $request->search . '%');
            })->latest()->get();



        $all_posts = $quests->merge($spots)->merge($business_locations)->merge($business_events);

        return view('search')
                ->with('quests', $quests)
                ->with('spots', $spots)
                ->with('business_events', $business_events)
                ->with('business_locations', $business_locations)
                ->with('all_posts', $all_posts)
                ->with('request', $request);
    }

}
