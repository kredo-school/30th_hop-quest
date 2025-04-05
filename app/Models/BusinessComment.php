<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessComment extends Model
{
    protected $table = 'business_comments';

    use SoftDeletes;

    public function business(){
        return $this->belongsTo(Business::class)->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function BusinessCommentLikes(){
        return $this->hasMany(BusinessCommentLike::class);
    }

    // Review → User（差出人）
    public function userRelation(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // Review → Spot（対象スポット）
    public function businessRelation(){
        return $this->belongsTo(Business::class, 'business_id');
    }
}
