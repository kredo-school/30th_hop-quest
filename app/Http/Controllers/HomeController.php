<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\Quest;
use App\Models\Spot;

class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $user;
    private $business;
    private $quest;
    private $spot;

    public function __construct(User $user, Business $business, Quest $quest, Spot $spot)
    {
        $this->user = $user;
        $this->business = $business;
        $this->quest = $quest;
        $this->spot = $spot;
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


// Posts
    public function posts_followings(){
        return view('home.posts.followings');
    }
    public function posts_quests(){
        return view('home.posts.quests');
    }
    public function posts_spots(){
        return view('home.posts.spots');
    }
    public function posts_locations(){
        return view('home.posts.locations');
    }
    public function posts_events(){
        return view('home.posts.events');
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

    //Allshow
    public function showAll(){
    // Quests
    $quests = Quest::select('title', 'introduction', 'main_photo', 'created_at', 'updated_at')
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->title,
                'introduction' => $item->introduction,
                'main_photo' => $item->main_image,
                'category_id' => null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

    // Spots
    $spots = Spot::select('title', 'introduction', 'main_image', 'created_at', 'updated_at')
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->title,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

    // Businesses -> Location
    $locations = Business::where('category_id', 1)
        ->with(['photos' => function ($q) {
            $q->orderBy('priority')->limit(1);
        }])
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->name,
                'introduction' => $item->introduction,
                'main_image' => optional($item->photos->first())->image,
                'category_id' => $item->category_id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

    // Businesses -> Event
    $events = Business::where('category_id', 2)
        ->with(['photos' => function ($q) {
            $q->orderBy('priority')->limit(1);
        }])
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->name,
                'introduction' => $item->introduction,
                'main_image' => optional($item->photos->first())->image,
                'category_id' => $item->category_id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

    // 全部まとめる
    $all = $quests->concat($spots)->concat($locations)->concat($events);

    // created_at順にソートしたい場合
    $all = $all->sortByDesc('created_at')->values();

    return view('home.posts.', compact('all'));
}


}
