<?php

namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestBody;

class QuestBodyController extends Controller
{
    private $quest_body;


    public function __construct(QuestBody $quest_body){
        $this->quest_body = $quest_body;
    }
}
