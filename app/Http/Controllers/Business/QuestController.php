<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Quest;

class QuestController extends Controller
{
    private $user;
    private $quest;

    public function __construct(Quest $quest, User $user){
        $this->quest = $quest;
        $this->user = $user;
    }
}
