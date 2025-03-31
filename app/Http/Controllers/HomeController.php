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
    public function showAll(Request $request){
    $sort = $request->get('sort', 'newest');
    // Spots
    $spots = Spot::with('user')
    ->withCount(['spotLikes as likes_count'])
    ->withCount(['spotComments as comments_count'])
    ->get()
    ->map(function ($item) {
        return [
            'id' => $item->id,
            'user' => $item->user,
            'user_id' => $item->user_id,
            'user_name' => optional($item->user)->name,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->title,
            'introduction' => $item->introduction,
            'main_image' => $item->main_image,
            'category_id' => null,
            'tab_id' => 1,
            'official_certification' => optional($item->user)->official_certification,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count, 
            'comments_count' => $item->comments_count,
            'is_liked' => $item->isLiked(),  
            'type' => 'spot',                  
        ];
    });

    // Quests
    $quests = Quest::with('user')
    ->withCount(['questLikes as likes_count'])
    ->withCount(['questComments as comments_count'])
    ->get()
    ->map(function ($item) {
        return [
            'id' => $item->id,
            'user' => $item->user,
            'user_id' => $item->user_id,
            'user_name' => optional($item->user)->name,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->title,
            'introduction' => $item->introduction,
            'main_image' => $item->main_image,
            'category_id' => null,
            'tab_id' => 2,
            'official_certification' => optional($item->user)->official_certification,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count,
            'comments_count' => $item->comments_count,
            'is_liked' => $item->isLiked(),
            'type' => 'quest',  
        ];
    });


    // Businesses -> Location
    $locations = Business::where('category_id', 1)
    ->withCount(['businessLikes as likes_count'])
    ->withCount(['businessComments as comments_count'])
    ->with([
        'photos' => function ($q) {
            $q->orderBy('priority')->limit(1);
        },
        'user' // ← ユーザー情報も一緒に取得
    ])
    ->get()
    ->map(function ($item) {
        return [
            'id' => $item->id,
            'user' => $item->user,
            'user_id' => $item->user_id,
            'user_name' => optional($item->user)->name,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->name,
            'introduction' => $item->introduction,
            'main_image' => $item->main_image,
            'category_id' => $item->category_id,
            'tab_id' => 3,
            'official_certification' => optional($item->user)->official_certification,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count, // ← 追加
            'is_liked' => $item->isLiked(),     // ← 追加
            'type' => 'business', 
        ];
    });

    // Businesses -> Event
    $events = Business::where('category_id', 2)
    ->withCount(['businessLikes as likes_count'])
    ->withCount(['businessComments as comments_count'])
    ->with([
        'photos' => function ($q) {
            $q->orderBy('priority')->limit(1);
        },
        'user' // ← ユーザー情報も一緒に取得
    ])
    ->get()
    ->map(function ($item) {
        return [
            'id' => $item->id,
            'user' => $item->user,
            'user_id' => $item->user_id,
            'user_name' => optional($item->user)->name,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->name,
            'introduction' => $item->introduction,
            'main_image' => $item->main_image,
            'category_id' => $item->category_id,
            'tab_id' => 4,
            'official_certification' => optional($item->user)->official_certification,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count, // ← 追加
            'is_liked' => $item->isLiked(),     // ← 追加
            'type' => 'business', 
        ];
    });

    // 全部まとめる
    $all = $quests->concat($spots)->concat($locations)->concat($events);

    switch ($sort) {
        case 'oldest':
            $all = $all->sortBy('created_at')->values();
            break;
        case 'likes':
            $all = $all->sortByDesc('likes_count')->values();
            break;
        case 'newest':
        default:
            $all = $all->sortByDesc('created_at')->values();
            break;
    }

    return view('home.posts.all', compact('all','quests'));
}

public function showQuests(){
    // Quests
    $quests = Quest::with('user')
    ->withCount(['questLikes as likes_count'])
    ->withCount(['spotComments as comments_count'])
    ->get()
    ->map(function ($item) {
        return [
            'id' => $item->id,
            'user' => $item->user,
            'user_id' => $item->user_id,
            'user_name' => optional($item->user)->name,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->title,
            'introduction' => $item->introduction,
            'main_image' => $item->main_image,
            'category_id' => null,
            'tab_id' => 2,
            'official_certification' => optional($item->user)->official_certification,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count, // ← 追加
            'is_liked' => $item->isLiked(),     // ← 追加
            'type' => 'quest', 
        ];
    });

    $quests = $quests->sortByDesc('created_at')->values();

    return view('home.posts.quests', compact('quests'));
    }

    public function showSpots(){
        // Spots
        $spots = Spot::with('user')
        ->withCount(['spotLikes as likes_count'])
        ->withCount(['spotComments as comments_count'])
        ->select('id', 'user_id', 'title', 'introduction', 'main_image', 'created_at', 'updated_at')
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'user_name' => optional($item->user)->name,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->title,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => null,
                'tab_id' => 1,
                'official_certification' => optional($item->user)->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, 
                'comment_count' => $item->comment_count,
                'is_liked' => $item->isLiked(), 
                'type' => 'spot', 
            ];
        });
    
        $spots = $spots->sortByDesc('created_at')->values();
    
        return view('home.posts.spots', compact('spots'));
    }

    public function showLocations(){
    // Locations
    $locations = Business::where('category_id', 1)
    ->withCount(['businessLikes as likes_count'])
    ->withCount(['businessComments as comments_count'])
    ->with([
        'photos' => function ($q) {
            $q->orderBy('priority')->limit(1);
        },
        'user' // ← ユーザー情報も一緒に取得
    ])
    ->get()
    ->map(function ($item) {
        return [
            'id' => $item->id,
            'user' => $item->user,
            'user_id' => $item->user_id,
            'user_name' => optional($item->user)->name,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->name,
            'introduction' => $item->introduction,
            'main_image' => optional($item->photos->first())->image,
            'category_id' => $item->category_id,
            'tab_id' => 3,
            'official_certification' => optional($item->user)->official_certification,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count, // ← 追加
            'is_liked' => $item->isLiked(),     // ← 追加
            'type' => 'business', 
        ];
    });
    
        $locations = $locations->sortByDesc('created_at')->values();
    
        return view('home.posts.locations', compact('locations'));
    }

    public function showEvents(){
    // Locations
    $events = Business::where('category_id', 2)
    ->withCount(['businessLikes as likes_count'])
    ->withCount(['businessComments as comments_count'])
    ->with([
        'photos' => function ($q) {
            $q->orderBy('priority')->limit(1);
        },
        'user' // ← ユーザー情報も一緒に取得
    ])
    ->get()
    ->map(function ($item) {
        return [
            'id' => $item->id,
            'user' => $item->user,
            'user_id' => $item->user_id,
            'user_name' => optional($item->user)->name,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->name,
            'introduction' => $item->introduction,
            'main_image' => optional($item->photos->first())->image,
            'category_id' => $item->category_id,
            'tab_id' => 4,
            'official_certification' => optional($item->user)->official_certification,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count, // ← 追加
            'is_liked' => $item->isLiked(),     // ← 追加
            'type' => 'business', 
        ];
    });
    
        $events = $events->sortByDesc('created_at')->values();
    
        return view('home.posts.events', compact('events'));
    }

    public function showFollowings(){
        $followedUserIds = Auth::user()->following->pluck('id')->toArray();
        // Spots
        $spots = Spot::with('user')
        ->withCount(['spotLikes as likes_count'])
        ->withCount(['spotComments as comments_count'])
        ->whereIn('user_id', $followedUserIds)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'user_name' => optional($item->user)->name,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->title,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => null,
                'tab_id' => 1,
                'official_certification' => optional($item->user)->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, 
                'comments_count' => $item->comments_count,
                'is_liked' => $item->isLiked(),     // ← 追加
                'type' => 'spot',                  
            ];
        });
    
        // Quests
        $quests = Quest::with('user')
        ->withCount(['questLikes as likes_count'])
        ->withCount(['questComments as comments_count'])
        ->whereIn('user_id', $followedUserIds)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'user_name' => optional($item->user)->name,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->title,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => null,
                'tab_id' => 2,
                'official_certification' => optional($item->user)->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count,
                'comments_count' => $item->comments_count,
                'is_liked' => $item->isLiked(),
                'type' => 'quest',  
            ];
        });
    
    
        // Businesses -> Location
        $locations = Business::where('category_id', 1)
        ->withCount(['businessLikes as likes_count'])
        ->withCount(['businessComments as comments_count'])
        ->with([
            'photos' => function ($q) {
                $q->orderBy('priority')->limit(1);
            },
            'user' // ← ユーザー情報も一緒に取得
        ])
        ->whereIn('user_id', $followedUserIds)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'user_name' => optional($item->user)->name,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->name,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => $item->category_id,
                'tab_id' => 3,
                'official_certification' => optional($item->user)->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, // ← 追加
                'comments_count' => $item->comments_count,
                'is_liked' => $item->isLiked(),     // ← 追加
                'type' => 'business', 
            ];
        });
    
        // Businesses -> Event
        $events = Business::where('category_id', 2)
        ->withCount(['businessLikes as likes_count'])
        ->withCount(['businessComments as comments_count'])
        ->with([
            'photos' => function ($q) {
                $q->orderBy('priority')->limit(1);
            },
            'user' // ← ユーザー情報も一緒に取得
        ])
        ->whereIn('user_id', $followedUserIds)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'user_name' => optional($item->user)->name,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->name,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => $item->category_id,
                'tab_id' => 4,
                'official_certification' => optional($item->user)->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, // ← 追加
                'comments_count' => $item->comments_count,
                'is_liked' => $item->isLiked(),     // ← 追加
                'type' => 'business', 
            ];
        });
    
        // 全部まとめる
        $all_followings = $quests->concat($spots)->concat($locations)->concat($events);
    
        // created_at順にソートしたい場合
        $all_followings = $all_followings->sortByDesc('created_at')->values();
    
        return view('home.posts.followings', compact('all_followings','quests'));
    }

}
