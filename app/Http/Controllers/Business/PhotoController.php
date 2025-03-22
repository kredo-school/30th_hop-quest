<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\Business;

class PhotoController extends Controller
{
    private $business;
    private $photo;

    public function __construct(Photo $photo, Business $business){
        $this->photo = $photo;
        $this->business = $business;
    }
}
