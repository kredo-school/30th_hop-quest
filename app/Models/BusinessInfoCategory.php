<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessInfoCategory extends Model
{
    public function businessInfos()
    {
        return $this->hasMany(BusinessInfo::class, 'business_info_category_id');
    }
}
