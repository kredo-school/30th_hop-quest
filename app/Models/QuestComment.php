<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestComment extends Model
{
    use SoftDeletes;

    public function quest(){
        return $this->belongsTo(Quest::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
