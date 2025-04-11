<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessDetail extends Model
{
    use SoftDeletes;

    protected $fillable = ['business_id', 'business_info_id', 'is_valid'];

    public function businessInfo()
    {
        return $this->belongsTo(BusinessInfo::class, 'business_info_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
