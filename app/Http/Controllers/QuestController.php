<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuestBody;
use App\Models\Quest;
use App\Models\User;

class QuestController extends Controller
{
    private $questbody;
    private $quest;

    public function __construct(Quest $quest, QuestBody $questbody){
        // $this->quest = new Quest();
        $this->questbody = $questbody;
        $this->quest = $quest;
    }

    public function storeQuest(Request $request){
        //validation
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:30',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'duration' => 'nullable|integer',
                'introduction' => 'nullable|string|max:40',
                'main_image' => 'required|file|max:1048|mimes:jpg,jpeg,png,gif',
                'is_public' => 'nullable|in:0,1',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); // Dumps all validation errors
        }
        
        $quest = new Quest();
        $this->quest->title = $request->title;
        $this->quest->user_id = Auth::user()->id;
        $this->quest->start_date = $request->start_date;
        $this->quest->end_date = $request->end_date;
        $this->quest->duration = $request->duration;
        $this->quest->introduction = $request->introduction;
        $this->quest->is_public = $request->is_public ?? "0";
        $this->quest->main_image = "data:main_image/".$request->main_image->extension().";base64,".base64_encode(file_get_contents($request->main_image));
        
        $this->quest->save();

        // セッションに quest_id を保存
        session(['quest_id' => $quest->id]);

        return redirect()->route('quest.add', ['user_id' => Auth::id()]);

    }

    public function storeQuestBody(Request $request){
        try {
            $validated = $request->validate([
                'day_number' => 'required|integer',
                'introduction' => 'required|string',
                'business_title' =>'nullable|max:30',
                'is_agenda' => 'nullable|in:0,1',
                'image' => 'required|file|max:1048|mimes:jpg,jpeg,png,gif',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    
        // 1️⃣ まずリクエストパラメータから `quest_id` を取得（編集ページから送られた場合）
        $quest_id = $request->input('quest_id');
    
        // 2️⃣ `quest_id` がリクエストにない場合（新規作成時）、セッションから取得
        if (!$quest_id) {
            $quest_id = session('quest_id');
        }
    
        // 3️⃣ `quest_id` が最終的に取得できなかった場合、エラーを返す
        if (!$quest_id) {
            return back()->withErrors(['error' => 'Quest ID が見つかりません。']);
        }
    
        // QuestBody の保存
        $questBody = new QuestBody();
        $questBody->quest_id = $quest_id; // `quest_id` を設定
        $questBody->spot_id = $request->spot_name->id ?? null; 
        $questBody->business_id = $request->spot_name->id ?? null;
        $questBody->day_number = $request->day_number;
        $questBody->introduction = $request->introduction;
        $questBody->business_title = $request->business_title;
        $questBody->is_agenda = $request->is_agenda ?? "1";
        $questBody->image = "data:image/".$request->image->extension().";base64,".base64_encode(file_get_contents($request->image));
    
        $questBody->save();
    
        return redirect()->route('quest.add', ['user_id' => Auth::id()]);
    }
    
    public function showAddQuest(){
        return view('quests.add-quest');
    }
}