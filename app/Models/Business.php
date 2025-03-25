<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;
   
    //business belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //business has many promotions
    public function promotions(){
        return $this->hasMany(Promotion::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function businessLikes(){
        return $this->hasMany(BusinessLike::class);
    }

    public function isLiked(){
        return $this->businessLikes()->where('user_id', Auth::user()->id)->exists();
    }

}
