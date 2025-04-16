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

    public function __construct(Spot $spot, User $user)
    {
        $this->spot = $spot;
        $this->user = $user;
    }

    public function toggleVisibility(Spot $spot)
    {
        if (Auth::id() !== $spot->user_id) {
            abort(403);
        }

        $spot->is_public = !$spot->is_public;
        $spot->save();

        return back()->with('status', 'Visibility updated.');
    }
}
