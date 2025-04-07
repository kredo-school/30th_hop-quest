<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Business extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
   
    //business belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //business has many promotions
    public function businessPromotions(){
        return $this->hasMany(BusinessPromotion::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function photoPriorityOne(){
        return $this->hasOne(Photo::class)->where('priority', 1);
    }

    public function topPhoto(){
        return $this->hasOne(Photo::class)->orderBy('priority', 'asc');
    }

    public function businessLikes(){
        return $this->hasMany(BusinessLike::class);
    }

    public function pageViews(){
        return $this->hasMany(PageView::class);
    }


    public function isLiked(){
        return $this->businessLikes()->where('user_id', Auth::user()->id)->exists();
    }

    public function view(): MorphOne{
        return $this->morphOne(PageView::class, 'page');
    }

    public function businessComments(){
        return $this->hasMany(BusinessComment::class);
    }

    public function businessDetails(){
        return $this->hasMany(BusinessDetail::class);
    }

    public function businessHours(){
        return $this->hasMany(BusinessHour::class);
    }
}
