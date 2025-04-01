<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Models\User;
use App\Models\Quest;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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
        return view('home.home');
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

//Allshow
    public function showAll(Request $request){
    $sort = $request->get('sort', 'latest');
    $perPage = 6;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    // Spots
    $spots = Spot::with('user')
    ->withCount(['spotLikes as likes_count'])
    ->withCount(['spotComments as comments_count'])
    // ->withCount(['pageViews as views_count'])
    ->get()
    ->map(function ($item) {
        return [
            'id' => $item->id,
            'user' => $item->user,
            'user_id' => $item->user_id,
            'user_name' => optional($item->user)->name,
            'user_official_certification' => optional($item->user)->official_certification,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->title,
            'introduction' => $item->introduction,
            'main_image' => $item->main_image,
            'category_id' => null,
            'tab_id' => 1,
            'official_certification' => null,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count, 
            'comments_count' => $item->comments_count,
            // 'views_count' => $item->views_count,
            'is_liked' => $item->isLiked(),  
            'type' => 'spot',                  
        ];
    });

    // Quests
    $quests = Quest::with('user')
    ->withCount(['questLikes as likes_count'])
    ->withCount(['questComments as comments_count'])
    // ->withCount(['pageViews as views_count'])
    ->get()
    ->map(function ($item) {
        return [
            'id' => $item->id,
            'user' => $item->user,
            'user_id' => $item->user_id,
            'user_name' => optional($item->user)->name,
            'user_official_certification' => optional($item->user)->official_certification,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->title,
            'introduction' => $item->introduction,
            'main_image' => $item->main_image,
            'category_id' => null,
            'tab_id' => 2,
            'official_certification' => null,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count,
            'comments_count' => $item->comments_count,
            // 'views_count' => $item->views_count,
            'is_liked' => $item->isLiked(),
            'type' => 'quest',  
        ];
    });


    // Businesses -> Location
    $locations = Business::where('category_id', 1)
    ->withCount(['businessLikes as likes_count'])
    ->withCount(['businessComments as comments_count'])
    // ->withCount(['pageViews as views_count'])
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
            'user_official_certification' => optional($item->user)->official_certification,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->name,
            'introduction' => $item->introduction,
            'main_image' => $item->main_image,
            'category_id' => $item->category_id,
            'tab_id' => 3,
            'official_certification' => $item->official_certification,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count, // ← 追加
            'comments_count' => $item->comments_count,
            // 'views_count' => $item->views_count,
            'is_liked' => $item->isLiked(),     // ← 追加
            'type' => 'business', 
        ];
    });

    // Businesses -> Event
    $events = Business::where('category_id', 2)
    ->withCount(['businessLikes as likes_count'])
    ->withCount(['businessComments as comments_count'])
    // ->withCount(['pageViews as views_count'])
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
            'user_official_certification' => optional($item->user)->official_certification,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->name,
            'introduction' => $item->introduction,
            'main_image' => $item->main_image,
            'category_id' => $item->category_id,
            'tab_id' => 4,
            'official_certification' => $item->official_certification,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count, // ← 追加
            'comments_count' => $item->comments_count,
            // 'views_count' => $item->views_count,
            'is_liked' => $item->isLiked(),     // ← 追加
            'type' => 'business', 
        ];
    });

    // 全部まとめる
    $all = $quests->concat($spots)->concat($locations)->concat($events);

        // 並び替え
        $all = match($sort) {
            'oldest' => $all->sortBy('created_at'),
            'likes'  => $all->sortByDesc('likes_count'),
            'comments'  => $all->sortByDesc('comments_count'),
            // 'views'  => $all->sortByDesc('views_count'),
            default  => $all->sortByDesc('created_at'), 
        };
    
        $all = $all->values(); // キーをリセット（重要）
    
        // ページネーション
        $paginated = new LengthAwarePaginator(
            $all->forPage($currentPage, $perPage),
            $all->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(), // ← クエリを保持！（sort=likes など）
            ]
        );
    
        return view('home.posts.all', [
            'all' => $paginated,
            'sort' => $sort, // Blade側で現在の並び順を表示するため
        ]);

        switch ($sort) {
            case 'oldest':
                $all = $all->sortBy('created_at')->values();
                break;
            case 'likes':
                $all = $all->sortByDesc('likes_count')->values();
                break;
            case 'comments':
                $all = $all->sortByDesc('comments_count')->values();
                break;
            // case 'views':
            //     $all = $all->sortByDesc('views_count')->values();
            //     break;
            case 'latest':
            default:
                $all = $all->sortByDesc('created_at')->values();
                break;
        }

        return view('home.posts.all', [
            'all' => $paginated,
        ]);

    }

public function showQuests(Request $request){
    $sort = $request->get('sort', 'latest');
    // Quests
    $quests = Quest::with('user')
    ->withCount(['questLikes as likes_count'])
    ->withCount(['questComments as comments_count'])
    // ->withCount(['pageViews as views_count'])
    ->get()
    ->map(function ($item) {
        return [
            'id' => $item->id,
            'user' => $item->user,
            'user_id' => $item->user_id,
            'user_name' => optional($item->user)->name,
            'user_official_certification' => optional($item->user)->official_certification,
            'avatar' => optional($item->user)->avatar,
            'title' => $item->title,
            'introduction' => $item->introduction,
            'main_image' => $item->main_image,
            'category_id' => null,
            'tab_id' => 2,
            'official_certification' => null,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'likes_count' => $item->likes_count, // ← 追加
            'comments_count' => $item->comments_count,
            // 'views_count' => $item->views_count,
            'is_liked' => $item->isLiked(),     // ← 追加
            'type' => 'quest', 
        ];
    });

    $quests = match($sort) {
        'oldest' => $quests->sortBy('created_at'),
        'likes'  => $quests->sortByDesc('likes_count'),
        'comments'  => $quests->sortByDesc('comments_count'),
        // 'views'  => $quests->sortByDesc('views_count'),
        default  => $quests->sortByDesc('created_at'), 
    };

    $quests = $quests->values(); // キーをリセット（重要）

    switch ($quests) {
        case 'oldest':
            $quests = $quests->sortBy('created_at')->values();
            break;
        case 'likes':
            $quests = $quests->sortByDesc('likes_count')->values();
            break;
        case 'comments':
            $quests = $quests->sortByDesc('comments_count')->values();
            break;
        // case 'views':
        //     $quests = $quests->sortByDesc('views_count')->values();
        //     break;
        case 'latest':
        default:
            $quests = $quests->sortByDesc('created_at')->values();
            break;
    }

    return view('home.posts.quests', compact('quests'));
    }

    public function showSpots(Request $request){
        $sort = $request->get('sort', 'latest');
        // Spots
        $spots = Spot::with('user')
        ->withCount(['spotLikes as likes_count'])
        ->withCount(['spotComments as comments_count'])
        // ->withCount(['pageViews as views_count'])
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'user_name' => optional($item->user)->name,
                'user_official_certification' => optional($item->user)->official_certification,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->title,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => null,
                'tab_id' => 1,
                'official_certification' => null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, 
                'comments_count' => $item->comments_count,
                // 'views_count' => $item->views_count,
                'is_liked' => $item->isLiked(), 
                'type' => 'spot', 
            ];
        });

        $spots = match($sort) {
            'oldest' => $spots->sortBy('created_at'),
            'likes'  => $spots->sortByDesc('likes_count'),
            'comments'  => $spots->sortByDesc('comments_count'),
            // 'views'  => $spots->sortByDesc('views_count'),
            default  => $spots->sortByDesc('created_at'), 
        };
    
        $spots = $spots->values(); // キーをリセット（重要）
    
        switch ($spots) {
            case 'oldest':
                $spots = $spots->sortBy('created_at')->values();
                break;
            case 'likes':
                $spots = $spots->sortByDesc('likes_count')->values();
                break;
            case 'comments':
                $spots = $spots->sortByDesc('comments_count')->values();
                break;
            // case 'views':
            //     $spots = $spots->sortByDesc('views_count')->values();
            //     break;
            case 'latest':
            default:
                $spots = $spots->sortByDesc('created_at')->values();
                break;
        }
    
        return view('home.posts.spots', compact('spots'));
    }

    public function showLocations(Request $request){
        $sort = $request->get('sort', 'latest');
        $perPage = 6;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Locations
        $locations = Business::where('category_id', 1)
        ->withCount(['businessLikes as likes_count'])
        ->withCount(['businessComments as comments_count'])
        // ->withCount(['pageViews as views_count'])
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
                'user_official_certification' => optional($item->user)->official_certification,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->name,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => $item->category_id,
                'tab_id' => 3,
                'official_certification' => $item->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, // ← 追加
                'comments_count' => $item->comments_count,
                // 'views_count' => $item->views_count,
                'is_liked' => $item->isLiked(),     // ← 追加
                'type' => 'business', 
            ];
        });
        
        $locations = match($sort) {
            'oldest' => $locations->sortBy('created_at'),
            'likes'  => $locations->sortByDesc('likes_count'),
            'comments'  => $locations->sortByDesc('comments_count'),
            // 'views'  => $locations->sortByDesc('views_count'),
            default  => $locations->sortByDesc('created_at'), 
        };
    
        $locations = $locations->values(); // キーをリセット（重要）
    
        // ページネーション
        $paginated = new LengthAwarePaginator(
            $locations->forPage($currentPage, $perPage),
            $locations->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(), // ← クエリを保持！（sort=likes など）
            ]
        );
    
        return view('home.posts.locations', [
            'locations' => $paginated,
            'sort' => $sort, // Blade側で現在の並び順を表示するため
        ]);

        switch ($sort) {
            case 'oldest':
                $locations = $locations->sortBy('created_at')->values();
                break;
            case 'likes':
                $locations = $locations->sortByDesc('likes_count')->values();
                break;
            case 'comments':
                $locations = $locations->sortByDesc('comments_count')->values();
                break;
            // case 'views':
            //     $locations = $locations->sortByDesc('views_count')->values();
            //     break;
            case 'latest':
            default:
                $locations = $locations->sortByDesc('created_at')->values();
                break;
        }

        return view('home.posts.locations', [
            'locations' => $paginated,
        ]);
    }

    public function showEvents(Request $request){
        $sort = $request->get('sort', 'latest');
        // Locations
        $events = Business::where('category_id', 2)
        ->withCount(['businessLikes as likes_count'])
        ->withCount(['businessComments as comments_count'])
        // ->withCount(['pageViews as views_count'])
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
                'user_official_certification' => optional($item->user)->official_certification,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->name,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => $item->category_id,
                'tab_id' => 4,
                'official_certification' => $item->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, // ← 追加
                'comments_count' => $item->comments_count,
                // 'views_count' => $item->views_count,
                'is_liked' => $item->isLiked(),     // ← 追加
                'type' => 'business', 
            ];
        });

        $events = match($sort) {
            'oldest' => $events->sortBy('created_at'),
            'likes'  => $events->sortByDesc('likes_count'),
            'comments'  => $events->sortByDesc('comments_count'),
            // 'views'  => $events->sortByDesc('views_count'),
            default  => $events->sortByDesc('created_at'), 
        };
    
        $events = $events->values(); // キーをリセット（重要）
    
        switch ($events) {
            case 'oldest':
                $events = $events->sortBy('created_at')->values();
                break;
            case 'likes':
                $events = $events->sortByDesc('likes_count')->values();
                break;
            case 'comments':
                $events = $events->sortByDesc('comments_count')->values();
                break;
            // case 'views':
            //     $events = $events->sortByDesc('views_count')->values();
            //     break;
            case 'latest':
            default:
                $events = $events->sortByDesc('created_at')->values();
                break;
        }
    
        return view('home.posts.events', compact('events'));
    }

    public function showFollowings(Request $request){
        $sort = $request->get('sort', 'latest');
        $perPage = 6;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $followedUserIds = Auth::user()->following->pluck('id')->toArray();
        // Spots
        $spots = Spot::with('user')
        ->withCount(['spotLikes as likes_count'])
        ->withCount(['spotComments as comments_count'])
        // ->withCount(['pageViews as views_count'])
        ->whereIn('user_id', $followedUserIds)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'user_name' => optional($item->user)->name,
                'user_official_certification' => optional($item->user)->official_certification,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->title,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => null,
                'tab_id' => 1,
                'official_certification' => null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, 
                'comments_count' => $item->comments_count,
                // 'views_count' => $item->views_count,
                'is_liked' => $item->isLiked(),     // ← 追加
                'type' => 'spot',                  
            ];
        });
    
        // Quests
        $quests = Quest::with('user')
        ->withCount(['questLikes as likes_count'])
        ->withCount(['questComments as comments_count'])
        // ->withCount(['pageViews as views_count'])
        ->whereIn('user_id', $followedUserIds)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'user_name' => optional($item->user)->name,
                'user_official_certification' => optional($item->user)->official_certification,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->title,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => null,
                'tab_id' => 2,
                'official_certification' => null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count,
                'comments_count' => $item->comments_count,
                // 'views_count' => $item->views_count,
                'is_liked' => $item->isLiked(),
                'type' => 'quest',  
            ];
        });
    
    
        // Businesses -> Location
        $locations = Business::where('category_id', 1)
        ->withCount(['businessLikes as likes_count'])
        ->withCount(['businessComments as comments_count'])
        // ->withCount(['pageViews as views_count'])
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
                'user_official_certification' => optional($item->user)->official_certification,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->name,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => $item->category_id,
                'tab_id' => 3,
                'official_certification' => $item->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, // ← 追加
                'comments_count' => $item->comments_count,
                // 'views_count' => $item->views_count,
                'is_liked' => $item->isLiked(),     // ← 追加
                'type' => 'business', 
            ];
        });
    
        // Businesses -> Event
        $events = Business::where('category_id', 2)
        ->withCount(['businessLikes as likes_count'])
        ->withCount(['businessComments as comments_count'])
        // ->withCount(['pageViews as views_count'])
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
                'user_official_certification' => optional($item->user)->official_certification,
                'avatar' => optional($item->user)->avatar,
                'title' => $item->name,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => $item->category_id,
                'tab_id' => 4,
                'official_certification' => $item->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, // ← 追加
                'comments_count' => $item->comments_count,
                // 'views_count' => $item->views_count,
                'is_liked' => $item->isLiked(),     // ← 追加
                'type' => 'business', 
            ];
        });

        $all_followings = $quests->concat($spots)->concat($locations)->concat($events);
    
            // 並び替え
            $all_followings = match($sort) {
                'oldest' => $all_followings->sortBy('created_at'),
                'likes'  => $all_followings->sortByDesc('likes_count'),
                'comments'  => $all_followings->sortByDesc('comments_count'),
                // 'views' => $all_followings->sortByDesc('views_count'),
                default  => $all_followings->sortByDesc('created_at'), 
            };
        
            $all_followings = $all_followings->values(); // キーをリセット（重要）
        
            // ページネーション
            $paginated = new LengthAwarePaginator(
                $all_followings->forPage($currentPage, $perPage),
                $all_followings->count(),
                $perPage,
                $currentPage,
                [
                    'path' => $request->url(),
                    'query' => $request->query(), // ← クエリを保持！（sort=likes など）
                ]
            );
        
            return view('home.posts.followings', [
                'all_followings' => $paginated,
                'sort' => $sort, // Blade側で現在の並び順を表示するため
            ]);
    
            switch ($sort) {
                case 'oldest':
                    $all_followings = $all_followings->sortBy('created_at')->values();
                    break;
                case 'likes':
                    $all_followings = $all_followings->sortByDesc('likes_count')->values();
                    break;
                case 'comments':
                    $all_followings = $all_followings->sortByDesc('comments_count')->values();
                    break;
                case 'latest':
                // case 'views':
                //     $all_followings = $all_followings->sortByDesc('views_count')->values();
                //     break;
                case 'latest':
                default:
                    $all_followings = $all_followings->sortByDesc('created_at')->values();
                    break;
            }
    
            return view('home.posts.followings', [
                'followings' => $paginated,
            ]);
    
    }

}
