<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessInfoCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the business info items for the category.
     */
    public function businessInfoItems()
    {
        return $this->hasMany(BusinessInfo::class, 'business_info_category_id');
    }
}
