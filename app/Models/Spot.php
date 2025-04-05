<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    public function user(){

        return $this->belongsTo(User::class);
    }

    public function spot(){
        return $this->hasMany(SpotLike::class);
    }
}
