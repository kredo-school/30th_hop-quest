<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessDetail extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['business_id'];

    protected $fillable = ['business_id', 'business_info_id', 'is_valid'];

    public function businessInfo()
    {
        return $this->belongsTo(BusinessInfo::class, 'business_info_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    
    /**
     * 施設の詳細カテゴリを取得するためのスタティックメソッド
     */
    public static function getAmenityCategories()
    {
        return [
            'Accessibility' => [
                'Wheelchair accessible', 'Elevator access', 'Accessible parking',
                'Accessible restroom', 'Braille signage', 'Hearing loop system'
            ],
            'Facilities' => [
                'Free Wi-Fi', 'Public restroom', 'Parking available',
                'Bicycle parking', 'Changing room', 'Shower facilities'
            ],
            'Payment Options' => [
                'Credit cards accepted', 'Google Pay and Apple Pay', 'Cash only', 'Cash accepted',
                'Visa and Mastercard contactless payment', 'Bitcoin payment'
            ],
            'Smoking Policy' => [
                'Completely non-smoking', 'Smoking area available',
                'Designated smoking rooms', 'Outdoor smoking section',
                'Smoking permitted throughout'
            ],
        ];
    }
    
    /**
     * 指定されたカテゴリの詳細情報を取得
     */
    public function getDetailsByCategory($category)
    {
        return $this->details()->where('category', $category)->pluck('name')->toArray();
    }
    
    /**
     * 指定された詳細が選択されているかどうか確認
     */
    public function hasDetail($category, $detailName)
    {
        return $this->details()
            ->where('category', $category)
            ->where('name', $detailName)
            ->exists();
    }
}