<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestComment extends Model
{
        //comment belongs to user
        public function user(){
            return $this->belongsTo(User::class)->withTrashed();
        }

        //Quest_Comment has many Quest_Comment_likes
        public function QuestCommentlikes(){
            return $this->hasMany(QuestCommentLike::class);
     }
}
