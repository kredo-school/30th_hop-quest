<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestComment extends Model
{
    use SoftDeletes;
    protected $table = 'quest_comments';

    public function quest(){
        return $this->belongsTo(Quest::class);
    }
}
