<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessHours;
use App\Models\BusinessInfoCategory;
use App\Models\BusinessPromotion;

class ViewBusiness extends Controller
{
    protected $business;
    protected $businessHours;

    public function __construct(Business $business, BusinessHours $businessHours, BusinessPromotion $businessPromotion)
    {
        $this->business = $business;
        $this->businessHours = $businessHours;
        $this->businessPromotion = $businessPromotion;
    }

    public function show($id)
    {
        $business = $this->business->find($id);
        $businessPromotions = $this->businessPromotion->where('business_id', $id)->get();
        $businessHours = $this->businessHours->where('business_id', $id)->get();
        $businessInfoCategories = BusinessInfoCategory::with(['businessInfos' => function($query) use ($id) {
            $query->with(['businessDetails' => function($query) use ($id) {
                $query->where('business_id', $id);
            }]);
        }])->get();

        return view('businessusers.posts.businesses.show')
                ->with('business', $business)
                ->with('businessHours', $businessHours)
                ->with('businessInfoCategories', $businessInfoCategories)
                ->with('businessPromotions', $businessPromotions);

    }

}
