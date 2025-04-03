<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestLike extends Model
{
    public $timestamps = false; //no timestamps

    //Quest_like belongs to user
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }
    
}

