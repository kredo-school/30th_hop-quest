<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpotLike extends Model
{
    protected $fillable = ['user_id', 'spot_id']; 
    protected $table = 'spot_likes';

    
    public $timestamps = false; 

} 