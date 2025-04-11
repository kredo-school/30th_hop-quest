<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestCommentLike extends Model
{

    public $timestamps = false; // 👈 これを追加！

    protected $fillable = [
        'user_id',
        'quest_comment_id', // ← これを追加！
    ];

    //Quest_omment_like belongs to user
    public function user(){
        return $this->belongsTo(User::class);
    }
}

