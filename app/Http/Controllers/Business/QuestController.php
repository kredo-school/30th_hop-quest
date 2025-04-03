<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Quest;
use App\Models\Business;

class QuestController extends Controller
{
    private $user;
    private $quest;
    private $business;

    public function __construct(Quest $quest, User $user, Business $business){
        $this->quest = $quest;
        $this->user = $user;
        $this->business = $business;
    }

    public function create(){
        $all_businesses = $this->business->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.posts.modelquests.add_n')->with('all_businesses',$all_businesses);
    }

    public function store(Request $request){
        //validation
        $request->validate([
            'title' => 'required',
            'introduction' => 'max:2000',
            'main_photo' => 'required|max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        $this->quest->title = $request->title;
        $this->quest->introduction = $request->introduction;
        $this->quest->duration = $request->duration;
        $this->quest->user_id = Auth::user()->id;
        $this->quest->main_photo = "data:photo/".$request->main_photo->extension().";base64,".base64_encode (file_get_contents($request->main_photo)); 

        $this->quest->save();

        $all_quests = $this->quest->where('user_id', Auth::user()->id)->latest()->get();
        return redirect()->route('profile.modelquests', $this->quest->user->id)->with('all_quests', $all_quests);
    }

    public function edit($id){
        $quest_a = $this->quest->findOrFail($id);
        $all_quests = $this->quest->where('user_id', Auth::user()->id)->latest()->get();
        return view('businessusers.posts.modelquests.edit_n')->with('quest', $quest_a);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'introduction' => 'max:2000',
            'main_photo' => 'max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        $all_quests = $this->quest->where('user_id', Auth::user()->id)->latest()->get();
        
        $quest_a = $this->quest->findOrFail($id);
        $quest_a->title = $request->title;
        $quest_a->introduction = $request->introduction;
        $quest_a->duration = $request->duration;
        $quest_a->user_id = Auth::user()->id;

        if($request->main_photo){
            $quest_a->main_photo = "data:photo/".$request->main_photo->extension().";base64,".base64_encode(file_get_contents($request->main_photo));
        }
        $quest_a->save();

        //redirect to Show Post
        return redirect()->route('profile.modelquests', Auth::user()->id)->with('all_quests', $all_quests);
    }

}
