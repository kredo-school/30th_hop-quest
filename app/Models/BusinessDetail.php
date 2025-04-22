<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'business_id',
        'business_info_id',
        'is_validity',
    ];

    protected $casts = [
        'is_validity' => 'boolean',
    ];

    /**
     * Get the business that owns the detail.
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Get the business info item associated with this detail.
     */
    public function businessInfo()
    {
        return $this->belongsTo(BusinessInfo::class, 'business_info_id');
    }
}
