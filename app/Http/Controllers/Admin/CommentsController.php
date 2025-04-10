<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\BusinessComment;
use App\Models\SpotComment;
use App\Models\QuestComment;
use App\Models\User;

class CommentsController extends Controller
{
    private $business_comment;
    private $spot_comment;
    private $quest_comment;
    private $user;
    
    public function __construct(BusinessComment $business_comment, SpotComment $spot_comment, QuestComment $quest_comment, User $user){
        $this->business_comment = $business_comment;
        $this->spot_comment = $spot_comment;
        $this->quest_comment = $quest_comment;
        $this->user = $user;
    }

    //Allshow
    public function indexComments(Request $request){
        $sort = $request->get('sort', 'created_at');
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Spots
        $spots = SpotComment::with('user')
        ->withTrashed()
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'spot_id' => $item->spot_id,
                'user_name' => optional($item->user)->name,
                'user_avatar' => optional($item->user)->avatar,
                'title' => $item->title,
                'category_id' => null,
                'tab_id' => 1,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'is_trashed' => method_exists($item, 'trashed') ? $item->trashed() : false,
                'type' => 'spots',                  
            ];
        });

        // Quests
        $quests = QuestComment::with('user')
        ->withTrashed()
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user,
                'user_id' => $item->user_id,
                'quest_id' => $item->quest_id,
                'user_name' => optional($item->user)->name,
                'content' => $item->content,
                'tab_id' => 1,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'is_trashed' => method_exists($item, 'trashed') ? $item->trashed() : false,
                'type' => 'quests',  
            ];
        });

        // 全部まとめる
        $comments = $quests->concat($spots);

        $comments = match($sort) {
            'oldest' => $comments->sortBy('created_at'),
            default  => $comments->sortByDesc('created_at'), 
        };

        $paginated = new LengthAwarePaginator(
            $comments->forPage($currentPage, $perPage),
            $comments->count(),
            $perPage,
            $currentPage,
            [
                'query' => $request->query(), // ← クエリを保持！（sort=likes など）
            ]

        );

        switch ($sort) {
            case 'oldest':
                $comments = $comments->sortBy('created_at')->values();
                break;
            case 'latest':
            default:                
                $comments = $comments->sortByDesc('created_at')->values();
                break;    
        }

            return view('admin.comments.all_comments', [
                'comments' => $paginated,
                'sort' => $sort,
            ]);

        }
}
