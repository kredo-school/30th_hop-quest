<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'business_info';

    protected $fillable = [
        'business_info_category_id',
        'name',
    ];

    /**
     * Get the category that owns the business info.
     */
    public function category()
    {
        return $this->belongsTo(BusinessInfoCategory::class, 'business_info_category_id');
    }

    /**
     * Get the business details for this info item.
     */
    public function businessDetails()
    {
        return $this->hasMany(BusinessDetail::class, 'business_info_id');
    }
}
