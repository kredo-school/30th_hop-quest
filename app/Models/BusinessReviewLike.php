<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessReviewLike extends Model
{
    protected $table = 'business_review_likes'; //table name is not in plural form, so note the different table name

    public $timestamps = false; //do not auto-save timestamps
    protected $fillable = ['user_id', 'review_id']; //for create() 

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function review(){
        return $this->belongsTo(Review::class);
    }
}
