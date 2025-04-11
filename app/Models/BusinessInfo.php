<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    public function category()
    {
        return $this->belongsTo(BusinessInfoCategory::class, 'business_info_category_id');
    }
}
