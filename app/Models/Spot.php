<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'main_image',
        'address',
        'introduction',
        'images',
        'geo_location',
        'geo_lat',
        'geo_lng'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function likes() 
    {
        return $this->hasMany(SpotLike::class);
    }

    public function comments()
    {
        return $this->hasMany(SpotComment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function views()
    // {
    //     return $this->hasMany(View::class);
    // }

    public function view(): MorphOne{
        return $this->morphOne(PageView::class, 'page');
    }

    public function spotLikes(){
        return $this->hasMany(SpotLike::class);
    }

    public function spotComments(){
        return $this->hasMany(SpotComment::class);
    }


    public function isLiked(){
        return $this->spotLikes()->where('user_id', Auth::user()->id)->exists();
    }

    public function pageViews()
    {
        return $this->morphMany(PageView::class, 'page');
    }
    
}
