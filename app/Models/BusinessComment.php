<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessComment extends Model
{
    protected $table = 'business_comments';

    public function business(){
        return $this->belongsTo(Business::class);
    }
}
