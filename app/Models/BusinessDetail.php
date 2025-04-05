<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessDetail extends Model
{
    protected $table = 'business_details';
    use SoftDeletes;

    public function details(){
        return $this->hasMany(Detail::class);
    }

    public function business(){
        return $this->belongsTo(Business::class);
    }
}
