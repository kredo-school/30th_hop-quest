<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestCommentLike extends Model
{
    protected $table = 'quest_comment_likes';

    public function questComment(){
        return $this->belongsTo(QuestComment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
