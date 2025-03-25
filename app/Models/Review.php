<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    public function business(){
        return $this->belongsTo(Business::class)->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function BusinessReviewLikes(){
        return $this->hasMany(BusinessReviewLike::class);
    }
}
