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
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function showBusinesses(Request $request, $id){
        $user_a = $this->user->findOrFail($id);
        $user_a->load(['businesses.photos' => function ($query) {
            $query->orderBy('priority', 'asc')->limit(1);
        }]);
        $reviews = DB::table('reviews')
            ->join('businesses', 'reviews.business_id', '=', 'businesses.id')
            ->where('businesses.user_id', $id)
            ->select('reviews.*') 
            ->get();
        $sort = $request->get('sort', 'latest');
        $perPage = 3;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Locations
        $locations = Business::where('category_id', 1)
        ->where('businesses.user_id', $id)
        ->withCount(['businessLikes as likes_count'])
        ->withCount(['businessComments as comments_count'])
        // ->withCount(['pageViews as views_count'])
        ->with([
            'photos' => function ($q) {
                $q->orderBy('priority')->limit(1);
            },
            'user' // ← ユーザー情報も一緒に取得
        ])
        // ->withCount(['pageViews as views_count'])
        ->withTrashed()
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'title' => $item->name,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => 1,
                'tab_id' => 1,
                'duration' => $item->duration,
                'official_certification' => $item->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, // ← 追加
                'comments_count' => $item->comments_count,
                // 'views_count' => $item->views_count,
                'is_liked' => $item->isLiked(),
                'is_trashed' => method_exists($item, 'trashed') ? $item->trashed() : false,
                'type' => 'businesses', 
            ];
        });

        // Locations
        $events = Business::where('category_id', 2)
        ->where('businesses.user_id', $id)
        ->withCount(['businessLikes as likes_count'])
        ->withCount(['businessComments as comments_count'])
        // ->withCount(['pageViews as views_count'])
        ->with([
            'photos' => function ($q) {
                $q->orderBy('priority')->limit(1);
            },
            'user' // ← ユーザー情報も一緒に取得
            ])
        // ->withCount(['pageViews as views_count'])
        ->withTrashed()
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'title' => $item->name,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => 2,
                'tab_id' => 2,
                'duration' => $item->duration,
                'official_certification' => $item->official_certification,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, // ← 追加
                'comments_count' => $item->comments_count,
                // 'views_count' => $item->views_count,
                'is_liked' => $item->isLiked(),
                'is_trashed' => method_exists($item, 'trashed') ? $item->trashed() : false,
                'type' => 'businesses', 
            ];
        });

        $businesses = $locations->concat($events);

        $businesses = match($sort) {
            default  => $businesses->sortByDesc('created_at'), 
        };

        // ページネーション
        $paginated = new LengthAwarePaginator(
            $businesses->forPage($currentPage, $perPage),
            $businesses->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(), // ← クエリを保持！（sort=likes など）
            ]
        );
        return view('businessusers.profiles.businesses', compact('reviews'),['businesses' => $paginated])->with('user', $user_a);
    }

    
    public function showPromotions(Request $request,$id){
        //get data of 1 user
        $user_a = $this->user->findOrFail($id);
        $all_businesses = $this->business->withTrashed()->where('user_id', $user_a->id)->latest()->get();
        $all_promotions = $this->promotion->withTrashed()->where('user_id', $user_a->id)->latest()->get();
        $reviews = DB::table('reviews')
        ->join('businesses', 'reviews.business_id', '=', 'businesses.id')
        ->where('businesses.user_id', $id)
        ->select('reviews.*') 
        ->get();
        $sort = $request->get('sort', 'latest');
        $perPage = 3;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Promotions        
        $promotions = Promotion::with('user', 'business')
        ->where('user_id', $user_a->id)
        ->withTrashed()
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'business_name' => optional($item->business)->name,
                'title' => $item->title,
                'introduction' => $item->introduction,
                'main_image' => $item->photo,
                'category_id' => null,
                'tab_id' => 3,
                'duration' => null,
                'official_certification' => null,
                'promotion_start' => $item->promotion_start,
                'promotion_end' => $item->promotion_end,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => null,
                'comments_count' => null,
                // 'views_count' => $item->views_count,
                'is_liked' => null,
                'is_trashed' => method_exists($item, 'trashed') ? $item->trashed() : false,
                'type' => 'promotions', 
            ];
        });

        $promotions = match($sort) {
            default  => $promotions->sortByDesc('created_at'), 
        };

        // ページネーション
        $paginated = new LengthAwarePaginator(
            $promotions->forPage($currentPage, $perPage),
            $promotions->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(), // ← クエリを保持！（sort=likes など）
            ]
        );

        return view('businessusers.profiles.promotions', compact('all_promotions','all_businesses', 'reviews'),['promotions' => $paginated])->with('user', $user_a);
    }


    public function showModelQuests(Request $request, $id){
        $user_a = $this->user->findOrFail($id);
        $all_businesses = $this->business->withTrashed()->where('user_id', $user_a->id)->latest()->get();
        $reviews = DB::table('reviews')
        ->join('businesses', 'reviews.business_id', '=', 'businesses.id')
        ->where('businesses.user_id', $id)
        ->select('reviews.*') 
        ->latest()->paginate(3);
        $sort = $request->get('sort', 'latest');
        $perPage = 3;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Quests        
        $quests = Quest::with('user')
        ->where('user_id', $user_a->id)
        ->withCount(['questLikes as likes_count'])
        ->withCount(['questComments as comments_count'])
        // ->withCount(['pageViews as views_count'])
        ->withTrashed()
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'title' => $item->title,
                'introduction' => $item->introduction,
                'main_image' => $item->main_image,
                'category_id' => null,
                'tab_id' => 4,
                'duration' => $item->duration,
                'official_certification' => null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'likes_count' => $item->likes_count, // ← 追加
                'comments_count' => $item->comments_count,
                // 'views_count' => $item->views_count,
                'is_liked' => $item->isLiked(),
                'is_trashed' => method_exists($item, 'trashed') ? $item->trashed() : false,
                'type' => 'quests', 
            ];
        });

        $quests = match($sort) {
            default  => $quests->sortByDesc('created_at'), 
        };

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

        return view('businessusers.profiles.quests', compact('all_businesses', 'reviews'),['quests' => $paginated])->with('user', $user_a);
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
