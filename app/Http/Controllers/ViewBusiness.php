<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\BusinessHours;

class ViewBusiness extends Controller
{
    protected $business;
    protected $businessHours;

    public function __construct(Business $business, BusinessHours $businessHours)
    {
        $this->business = $business;
        $this->businessHours = $businessHours;
    }

    public function show($id)
    {
        $business = $this->business->find($id);
        $businessHours = $this->businessHours->where('business_id', $id)->get();

        if (!$business) {
            abort(404);
        }

        return view('business', compact('business', 'businessHours'));
    }

}
