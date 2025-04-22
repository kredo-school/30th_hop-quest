<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Business extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'name',
        'main_image',
        'introduction',
        'category_id',
        'status',
        'term_start',
        'term_end',
        'business_hours',
        'sp_notes',
        'address_1',
        'address_2',
        'zip',
        'phonenumber',
        'email',
        'website_url',
        'instagram',
        'facebook',
        'x',
        'tiktok',
        'official_certification',
        'identification_number',
        'display_start',
        'display_end'
    ];
    
    protected $casts = [
        'term_start' => 'date',
        'term_end' => 'date',
        'display_start' => 'date',
        'display_end' => 'date',
    ];
   
    //business belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //business has many promotions
    public function businessPromotions(){
        return $this->hasMany(BusinessPromotion::class);
    }

    public function businessComment(){
        return $this->hasMany(BusinessComment::class);
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
        return $this->morphMany(PageView::class, 'page');
    }

    public function isLiked(){
        if (!Auth::check()) {
            return false;
        }
        return $this->businessLikes()->where('user_id', Auth::user()->id)->exists();
    }

    public function views(): MorphMany{
        return $this->morphMany(PageView::class, 'page');
    }

    public function businessComments(){
        return $this->hasMany(BusinessComment::class);
    }

    public function likes(){
        return $this->hasMany(BusinessLike::class);
    }

    public function comments(){
        return $this->hasMany(BusinessComment::class);
    }

    public function businessDetails(){
        return $this->hasMany(BusinessDetail::class);
    }

    public function businessHours(){
        return $this->hasMany(BusinessHour::class);
    }

    /**
     * ビジネスに関連する詳細情報項目を取得
     * (business_infoテーブルとのリレーション)
     */
    public function businessInfo(){
        return $this->belongsToMany(BusinessInfo::class, 'business_details', 'business_id', 'business_info_id')
                    ->withPivot('is_validity')
                    ->withTimestamps();
    }
    
    /**
     * ビジネスに関連するロケーションを取得
     */
    public function locations(){
        return $this->hasMany(Location::class);
    }

    /**
     * ビジネスに関連するイベントを取得
     */
    public function events(){
        return $this->hasMany(Event::class);
    }

    /**
     * ビジネス詳細がアクティブな情報項目のみを取得
     */
    public function activeBusinessInfo(){
        return $this->belongsToMany(BusinessInfo::class, 'business_details', 'business_id', 'business_info_id')
                    ->withPivot('is_validity')
                    ->wherePivot('is_validity', true)
                    ->withTimestamps();
    }

    /**
     * カテゴリによってビジネスがロケーションかを判断
     */
    public function isLocation(){
        return $this->category_id === 1;
    }

    /**
     * カテゴリによってビジネスがイベントかを判断
     */
    public function isEvent(){
        return $this->category_id === 2;
    }
}