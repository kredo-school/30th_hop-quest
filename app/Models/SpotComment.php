<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpotComment extends Model
{
    use SoftDeletes;

    public function spot(){
        return $this->belongsTo(Spot::class);
    }    
}
