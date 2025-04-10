<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestComment extends Model
{

        //comment belongs to user
        public function user(){
            return $this->belongsTo(User::class);
        }

        //Quest_Comment has many Quest_Comment_likes
        public function questCommentlikes(){
            return $this->hasMany(QuestCommentLike::class, 'quest_comment_id');
     }
}
