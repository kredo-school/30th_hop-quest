<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Spot;

class SpotController extends Controller
{
    private $user;
    private $spot;

    public function __construct(Spot $spot, User $user){
        $this->spot = $spot;
        $this->user = $user;
    }

}
