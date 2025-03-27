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
    private $user;

    public function __construct(QuestBody $questbody, Quest $quest){
        $this->questbody = $questbody;
        $this->quest = $quest;
    }

    public function storeQuest(Request $request){
        //validation
        $request->validate([
            'title' => 'required|string|max:30',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'duration' => 'nullable|integer',
            'intro' => 'nullable|string|max:40',
            'h_photo' => 'required|file|max:1048|mimes:jpg,jpeg,png,gif',
            'is_public' => 'nullable|in:0,1',
        ]);
        
        $this->quest = new Quest(); // ここを追加！
        $this->quest->title = $request->title;
        $this->quest->user_id = Auth::user()->id;
        $this->quest->start_date = $request->start_date;
        $this->quest->end_date = $request->end_date;
        $this->quest->duration = $request->duration;
        $this->quest->introduction = $request->introduction;

        if ($request->hasFile('h_photo')) {
            $file = $request->file('h_photo');
            $fileContents = file_get_contents($file->getRealPath());
        
            if (!$fileContents) {
                dd("Error: Could not read file contents"); // デバッグ
            }
        
            $this->quest->main_photo = "data:image/".$file->extension().";base64,".base64_encode($fileContents);
        } else {
            dd("Error: No file uploaded"); // デバッグ
        }
        

        $this->quest->main_photo = "data:image/".$request->h_photo->extension().";base64,".base64_encode(file_get_contents($request->h_photo));
        $this->quest->is_public = $request->is_public ?? "no";
        
        $this->quest->save();
        dd($quest->all()); // 保存後のデータを確認

        return redirect()->route('quest.add', ['user_id' => Auth::id()]);
    }

    public function showAddQuest(){
        return view('quests.add-quest');
    }
}