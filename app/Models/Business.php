<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class Business extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class);
    }

}

