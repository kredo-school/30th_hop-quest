<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function spotLikes(){
        return $this->hasMany(SpotLike::class);
    }

    public function spotComments(){
        return $this->hasMany(SpotComment::class);
    }

    public function pageViews(){
        return $this->hasMany(PageView::class);
    }

    public function isLiked(){
        return $this->spotLikes()->where('user_id', Auth::user()->id)->exists();
    }
    
}
