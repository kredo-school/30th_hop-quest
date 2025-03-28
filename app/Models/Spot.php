<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function views()
    {
        return $this->hasMany(View::class);
    }
}
