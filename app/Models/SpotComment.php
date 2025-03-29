<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpotComment extends Model
{
    protected $fillable = ['user_id', 'spot_id', 'content']; 
    protected $table = 'spot_comments';

    
    public function likes()
    {
        return $this->hasMany(SpotCommentLike::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 