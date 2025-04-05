<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Models\User;
use App\Models\Quest;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $user;
    private $quest;
    private $spot;
    private $business;

    public function __construct(User $user, Quest $quest, Spot $spot, Business $business)
    {
        $this->user     = $user;
        $this->quest    = $quest;
        $this->spot     = $spot;
        $this->business = $business;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        return view('home.home');
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



        $all_posts = $quests->concat($spots)->concat($business_locations)->concat($business_events);

        return view('home.search')
                ->with('quests', $quests)
                ->with('spots', $spots)
                ->with('business_events', $business_events)
                ->with('business_locations', $business_locations)
                ->with('all_posts', $all_posts)
                ->with('request', $request);
    }

    public function sort (Request $request){

        $category = $request->input('data-category');
        $sort = $sort->input('sort');

        switch($category){
            case 'spot':
                $query = Spot::query();
                break;
            case 'quest':
                $query = Quest::query();
                break;
            case 'location':
                $query = Business::where('category_id', '1');
                break;
            case 'event':
                $query = Business::where('category_id', '2');
                break;
            default:
                $query = Spot::query()->concat(Quest::query())->concat(Business::where('category_id', '1'))->concat(Business::where('category_id', '2'));
                break;
        }

        if($sort === 'likes'){
            $query = $query->withCount('likes')->sortByDesc('likes_count')->get();
        }elseif($sort === 'comments'){
            $query = $query->withCount('comments')->sortByDesc('comments_count')->get();
        }elseif($sort === 'views'){
            $query = $query->withCount('views')->sortByDesc('views_count')->get();
        }else{
            $query = $query->latest()->get();
        }
    }
}
