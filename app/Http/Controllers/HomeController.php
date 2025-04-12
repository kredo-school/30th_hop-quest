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

        $popular_quests     = Quest::with('views')->whereHas('views')->get()
                        ->sortByDesc(fn($quest) => $quest->view->views ?? 0)->take(9)->values();

        $popular_spots      = Spot::with('views')->whereHas('views')->get()
                        ->sortByDesc(fn($spot) => $spot->view->views ?? 0)->take(9)->values();

        $popular_locations  = Business::with('views')->whereHas('views')->where('category_id' ,'1')->get()
                        ->sortByDesc(fn($location) => $location->view->views ?? 0)->take(9)->values();
        
        $popular_events     = Business::with('views')->whereHas('views')->where('category_id' ,'2')->get()
                        ->sortByDesc(fn($event) => $event->view->views ?? 0)->take(9)->values();
        
        $popular_follwings  = $popular_quests->concat($popular_spots)->concat($popular_locations)->concat($popular_events)
                        ->sortByDesc(fn($post) => $post->view->views ?? 0)->take(9)->values();

        return view('home.home')
                ->with('popular_quests', $popular_quests)
                ->with('popular_spots', $popular_spots)
                ->with('popular_locations', $popular_locations)
                ->with('popular_events', $popular_events)
                ->with('popular_follwings', $popular_follwings);
    }
    

    // Search Result
    public function search(Request $request){

        $quests = Quest::where('title', 'like', "%{$request->search}%")
                        ->orWhere('introduction', 'like', "%{$request->search}%")
                        ->latest()
                        ->get();

        $spots = Spot::where('title', 'like', "%{$request->search}%")
                        ->orWhere('introduction', 'like', "%{$request->search}%")
                        ->latest()
                        ->get();

        $business_locations = Business::where('category_id', '1')
                                ->where(function ($query) use ($request) {
                                    $query->where('name', 'like', "%{$request->search}%")
                                          ->orWhere('introduction', 'like', "%{$request->search}%");
                                })
                                ->latest()
                                ->get();

        $business_events = Business::where('category_id', '2')
                                ->where(function ($query) use ($request) {
                                    $query->where('name', 'like', "%{$request->search}%")
                                          ->orWhere('introduction', 'like', "%{$request->search}%");
                                })
                                ->latest()
                                ->get();

        $all = $quests->concat($spots)->concat($business_locations)->concat($business_events);

        $currentPage = LengthAwarePaginator::resolveCurrentPage('all_page');
        $perPage = 9;
        $currentItems = $all->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $all_posts = new LengthAwarePaginator(
            $currentItems,
            $all->count(),
            $perPage,
            $currentPage,
            ['path' => url('/search'), 'pageName' => 'all_page']
        );

        return view('home.search')
                ->with(compact('quests', 'spots', 'business_locations', 'business_events', 'all_posts', 'request'));
    }

    public function sort(Request $request){
        $category = $request->input('data-category');
        $sort = $request->input('sort');
        $page = $request->input('page', 1);
        $pageName = $category . '_page';

        switch ($category) {
            case 'spot':
                $query = Spot::where('title', 'like', "%{$request->search}%")
                            ->orWhere('introduction', 'like', "%{$request->search}%");
                break;
            case 'quest':
                $query = Quest::where('title', 'like', "%{$request->search}%")
                            ->orWhere('introduction', 'like', "%{$request->search}%");
                break;
            case 'location':
                $query = Business::where('category_id', '1')
                                ->where(function ($q) use ($request) {
                                    $q->where('name', 'like', "%{$request->search}%")
                                      ->orWhere('introduction', 'like', "%{$request->search}%");
                                });
                break;
            case 'event':
                $query = Business::where('category_id', '2')
                                ->where(function ($q) use ($request) {
                                    $q->where('name', 'like', "%{$request->search}%")
                                      ->orWhere('introduction', 'like', "%{$request->search}%");
                                });
                break;
            default:
                return response()->json([
                    'html' => $this->renderAllSorted($sort, $request)
                ]);
        }

        if ($sort === 'likes') {
            $query = $query->withCount('likes')->orderByDesc('likes_count');
        } elseif ($sort === 'views') {
            $query = $query->withCount('views')->orderByDesc('views_count');
        } elseif ($sort === 'comments') {
            $query = $query->withCount('comments')->orderByDesc('comments_count');
        } elseif ($sort === 'oldest') {
            $query = $query->oldest();
        } else {
            $query = $query->latest();
        }

        $posts = $query->paginate(9, ['*'], $pageName, $page)
                       ->appends($request->query());

        return response()->json([
            'html' => view('home.search-result-body-list', compact('posts'))->render()
        ]);
    }

    private function renderAllSorted($sort, Request $request)
    {
        $spots = Spot::where('title', 'like', "%{$request->search}%")
                        ->orWhere('introduction', 'like', "%{$request->search}%")
                        ->withCount(['likes', 'views', 'comments'])
                        ->get();

        $quests = Quest::where('title', 'like', "%{$request->search}%")
                        ->orWhere('introduction', 'like', "%{$request->search}%")
                        ->withCount(['likes', 'views', 'comments'])
                        ->get();

        $locations = Business::where('category_id', '1')
                        ->where(function ($query) use ($request) {
                            $query->where('name', 'like', "%{$request->search}%")
                                  ->orWhere('introduction', 'like', "%{$request->search}%");
                        })
                        ->withCount(['likes', 'views', 'comments'])
                        ->get();

        $events = Business::where('category_id', '2')
                        ->where(function ($query) use ($request) {
                            $query->where('name', 'like', "%{$request->search}%")
                                  ->orWhere('introduction', 'like', "%{$request->search}%");
                        })
                        ->withCount(['likes', 'views', 'comments'])
                        ->get();

        $all = $spots->concat($quests)->concat($locations)->concat($events);

        if ($sort === 'likes') {
            $sorted = $all->sortByDesc('likes_count');
        } elseif ($sort === 'views') {
            $sorted = $all->sortByDesc('views_count');
        } elseif ($sort === 'comments') {
            $sorted = $all->sortByDesc('comments_count');
        } elseif ($sort === 'oldest') {
            $sorted = $all->sortBy('created_at');
        } else {
            $sorted = $all->sortByDesc('created_at');
        }

        $currentPage = $request->input('all_page', 1);
        $perPage = 9;
        $currentItems = $sorted->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $posts = new LengthAwarePaginator(
            $currentItems,
            $sorted->count(),
            $perPage,
            $currentPage,
            ['path' => url('/search'), 'pageName' => 'all_page']
        );

        return view('home.search-result-body-list', ['posts' => $posts])->render();
    }


//Allshow
    public function showAll(Request $request){
    $sort = $request->get('sort', 'likes_count');
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
            'type' => 'spots',                  
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
            'type' => 'quests',  
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
            'type' => 'businesses', 
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
            'type' => 'businesses', 
        ];
    });

    // 全部まとめる
    $all = $quests->concat($spots)->concat($locations)->concat($events);

        // 並び替え
        $all = match($sort) {
            'latest' => $all->sortByDesc('created_at'),
            'oldest' => $all->sortBy('created_at'),
            'comments'  => $all->sortByDesc('comments_count'),
            // 'views'  => $all->sortByDesc('views_count'),
            default  => $all->sortByDesc('likes_count'), 
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

        switch ($sort) {
            case 'oldest':
                $all = $all->sortBy('created_at')->values();
                break;
            case 'latest':
                $all = $all->sortByDesc('created_at')->values();
                break;                           
            case 'comments':
                $all = $all->sortByDesc('comments_count')->values();
                break;
            // case 'views':
            //     $all = $all->sortByDesc('views_count')->values();
            //     break;
            case 'likes':
            default:                
                $all = $all->sortByDesc('likes_count')->values();
                break;    
        }

        return view('home.posts.all', [
            'all' => $paginated,
            'sort' => $sort, // Blade側で現在の並び順を表示するため
        ]);

    }

public function showQuests(Request $request){
    $sort = $request->get('sort', 'likes_count');
    $perPage = 6;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
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
            'type' => 'quests', 
        ];
    });

    $quests = match($sort) {
        'latest' => $quests->sortByDesc('created_at'),
        'oldest' => $quests->sortBy('created_at'),
        'comments'  => $quests->sortByDesc('comments_count'),
        // 'views'  => $all->sortByDesc('views_count'),
        default  => $quests->sortByDesc('likes_count'), 
    };

    $quests = $quests->values(); // キーをリセット（重要）

    // ページネーション
    $paginated = new LengthAwarePaginator(
        $quests->forPage($currentPage, $perPage),
        $quests->count(),
        $perPage,
        $currentPage,
        [
            'path' => $request->url(),
            'query' => $request->query(), // ← クエリを保持！（sort=likes など）
        ]
    );

    switch ($quests) {
        case 'oldest':
            $quests = $quests->sortBy('created_at')->values();
            break;
        case 'latest':
            $quests = $quests->sortByDesc('created_at')->values();
            break;                           
        case 'comments':
            $quests = $quests->sortByDesc('comments_count')->values();
            break;
        // case 'views':
        //     $quests = $quests->sortByDesc('views_count')->values();
        //     break;
        case 'likes':
        default:                
            $quests = $quests->sortByDesc('likes_count')->values();
            break;  
    }

    return view('home.posts.quests', [
        'quests' => $paginated,
        'sort' => $sort, // Blade側で現在の並び順を表示するため
    ]);
}

    public function showSpots(Request $request){
        $sort = $request->get('sort', 'likes_count');
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
                'type' => 'spots', 
            ];
        });

        $spots = match($sort) {
            'latest' => $spots->sortByDesc('created_at'),
            'oldest' => $spots->sortBy('created_at'),
            'comments'  => $spots->sortByDesc('comments_count'),
            // 'views'  => $spots->sortByDesc('views_count'),
            default  => $spots->sortByDesc('likes_count'), 
        };
    
        $spots = $spots->values(); // キーをリセット（重要）

            // ページネーション
        $paginated = new LengthAwarePaginator(
            $spots->forPage($currentPage, $perPage),
            $spots->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(), // ← クエリを保持！（sort=likes など）
            ]
        );
    
        switch ($sort) {
            case 'oldest':
                $spots = $spots->sortBy('created_at')->values();
                break;
            case 'latest':
                $spots = $spots->sortByDesc('created_at')->values();
                break;                           
            case 'comments':
                $spots = $spots->sortByDesc('comments_count')->values();
                break;
            // case 'views':
            //     $spots = $spots->sortByDesc('views_count')->values();
            //     break;
            case 'likes':
            default:                
                $spots = $spots->sortByDesc('likes_count')->values();
                break;  
        }
    
        return view('home.posts.spots', [
            'spots' => $paginated,
            'sort' => $sort, // Blade側で現在の並び順を表示するため
        ]);
    }

    public function showLocations(Request $request){
        $sort = $request->get('sort', 'likes_count');
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
                'type' => 'businesses', 
            ];
        });
        
        $locations = match($sort) {
            'latest' => $locations->sortByDesc('created_at'),
            'oldest' => $locations->sortBy('created_at'),
            'comments'  => $locations->sortByDesc('comments_count'),
            // 'views'  => $locations->sortByDesc('views_count'),
            default  => $locations->sortByDesc('likes_count'), 
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

        switch ($sort) {
            case 'oldest':
                $locations = $locations->sortBy('created_at')->values();
                break;
            case 'latest':
                $locations = $locations->sortByDesc('created_at')->values();
                break;                           
            case 'comments':
                $locations = $locations->sortByDesc('comments_count')->values();
                break;
            // case 'views':
            //     $locations = $locations->sortByDesc('views_count')->values();
            //     break;
            case 'likes':
            default:                
                $locations = $locations->sortByDesc('likes_count')->values();
                break;  
        }

        return view('home.posts.locations', [
            'locations' => $paginated,
            'sort' => $sort, // Blade側で現在の並び順を表示するため
        ]);
    }

    public function showEvents(Request $request){
        $sort = $request->get('sort', 'likes_count');
        $perPage = 6;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
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
                'type' => 'businesses', 
            ];
        });

        $events = match($sort) {
            'latest' => $events->sortByDesc('created_at'),
            'oldest' => $events->sortBy('created_at'),
            'comments'  => $events->sortByDesc('comments_count'),
            // 'views'  => $events->sortByDesc('views_count'),
            default  => $events->sortByDesc('likes_count'), 
        };
    
        $events = $events->values(); // キーをリセット（重要）

        // ページネーション
        $paginated = new LengthAwarePaginator(
            $events->forPage($currentPage, $perPage),
            $events->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(), // ← クエリを保持！（sort=likes など）
            ]
        );
    
        switch ($sort) {
            case 'oldest':
                $events = $events->sortBy('created_at')->values();
                break;
            case 'latest':
                $events = $events->sortByDesc('created_at')->values();
                break;                           
            case 'comments':
                $events = $events->sortByDesc('comments_count')->values();
                break;
            // case 'views':
            //     $events = $events->sortByDesc('views_count')->values();
            //     break;
            case 'likes':
            default:                
                $events = $events->sortByDesc('likes_count')->values();
                break;  
        }
    
        return view('home.posts.events', compact('events'));
    }

    public function showFollowings(Request $request){
        $sort = $request->get('sort', 'likes_count');
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
                'type' => 'spots',                  
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
                'type' => 'quests',  
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
                'type' => 'businesses', 
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
                'type' => 'businesses', 
            ];
        });

        $all_followings = $quests->concat($spots)->concat($locations)->concat($events);
    
        // 並び替え
        $all_followings = match($sort) {
            'latest' => $all_followings->sortByDesc('created_at'),
            'oldest' => $all_followings->sortBy('created_at'),
            'comments'  => $all_followings->sortByDesc('comments_count'),
            // 'views'  => $all_followings->sortByDesc('views_count'),
            default  => $all_followings->sortByDesc('likes_count'), 
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
    
        switch ($sort) {
            case 'oldest':
                $all_followings = $all_followings->sortBy('created_at')->values();
                break;
            case 'latest':
                $all_followings = $all_followings->sortByDesc('created_at')->values();
                break;                           
            case 'comments':
                $all_followings = $all_followings->sortByDesc('comments_count')->values();
                break;
            // case 'views':
            //     $all_followings = $all_followings->sortByDesc('views_count')->values();
            //     break;
            case 'likes':
            default:                
                $all_followings = $all_followings->sortByDesc('likes_count')->values();
                break; 
        }

        return view('home.posts.followings', [
            'all_followings' => $paginated,
            'sort' => $sort, // Blade側で現在の並び順を表示するため
        ]);

    }

}
