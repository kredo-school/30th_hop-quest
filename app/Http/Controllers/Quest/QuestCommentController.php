<?php
namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuestComment;
use App\Models\QuestCommentLike;
use App\Models\QuestBody;

class QuestCommentController extends Controller
{
    //cpmment
    public function toggleCommentLike($commentId) { 
        $user = Auth::user(); 
        $comment = QuestComment::findOrFail($commentId);
        $like = QuestCommentLike::where('quest_comment_id', $comment->id)
                            ->where('user_id', $user->id)
                            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            QuestCommentLike::create([
                'quest_comment_id' => $comment->id,
                'user_id' => $user->id, // ✅ これを忘れずに！
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'like_count' => $comment->questCommentLikes()->count(),
            'quest_id' => $comment->quest_id // ← クエストIDを追加！
        ]);
    }
    
    public function getCommentStats($questId) { 
        $comments = QuestComment::with('questCommentLikes') ->where('quest_id', $questId) ->get();
        $data = $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'like_count' => $comment->questCommentLikes->count(),
                'liked_by_auth_user' => $comment->questCommentLikes->contains('user_id', Auth::id())
            ];
        });
        
        return response()->json([
            'comment_count' => $comments->count(),
            'comment_stats' => $data,
        ]);
    }
    
    public function storeQuestComment(Request $request, $quest_id){
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
    
        $comment = new QuestComment();
        $comment->quest_id = $quest_id;
        $comment->user_id = Auth::id();
        $comment->content = $request->input('content');
        $comment->save();
    
        return redirect()->back()->with('message', 'Comment posted!');
    }
    
    public function deleteQuestComment($id){
        $comment = QuestComment::findOrFail($id);
    
        // コメントの所有者だけが削除できる
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    
        $comment->delete();
    
        // 正しいルート名 'show' にリダイレクト
        return redirect()->route('quest.show', $comment->quest_id)
                         ->with('message', 'Comment deleted.');
    }
}
