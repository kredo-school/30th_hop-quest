<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessHour;
use App\Models\BusinessInfoCategory;
use App\Models\BusinessPromotion;

class ViewBusiness extends Controller
{
    protected $business;
    protected $businessHours;

    public function __construct(Business $business, BusinessHour $businessHours, BusinessPromotion $businessPromotion)
    {
        $this->business = $business;
        $this->businessHours = $businessHours;
        $this->businessPromotion = $businessPromotion;
    }

    public function show($id)
    {
        try {
            $business = $this->business->findOrFail($id);
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
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('home')->with('error', 'ビジネス情報が見つかりませんでした。');
        }
    }

}
