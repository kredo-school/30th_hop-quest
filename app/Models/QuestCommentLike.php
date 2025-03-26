<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestCommentLike extends Model
{
    //Quest_omment_like belongs to user
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }
}
