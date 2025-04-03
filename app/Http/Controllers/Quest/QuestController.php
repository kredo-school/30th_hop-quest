<?php

namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuestBody;
use App\Models\Quest;
use App\Models\Spot;
use App\Models\Business;
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
// =============================================================Add Quest
    public function storeQuest(Request $request){
        //validation
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:30',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'duration' => 'nullable|integer',
                'introduction' => 'nullable|string|max:500',
                'main_image' => 'required|file|max:1048|mimes:jpg,jpeg,png,gif',
                'is_public' => 'nullable|in:0,1',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); // Dumps all validation errors
        }
        try{
        $quest = new Quest();
        $quest->title = $request->title;
        $quest->user_id = Auth::user()->id;
        $quest->start_date = $request->start_date;
        $quest->end_date = $request->end_date;
        $quest->duration = $request->duration;
        $quest->introduction = $request->introduction;
        $quest->is_public = $request->is_public ?? "0";
        $quest->main_image = "data:main_image/".$request->main_image->extension().";base64,".base64_encode(file_get_contents($request->main_image));

        $quest->save();
        $quest->refresh(); // IDを確実に取得する
        // session(['test' => 'hello']);
        // dd(session('test')); // "hello" が表示されるか確認

        // dd($quest); // ここで ID が入っているか確認
        // dd(gettype($quest->id), $quest->id);

        // session(['quest_id' => $quest->id]);
        // session()->save(); // 🔥 セッションを手動で確定させる
        // dd(session('quest_id')); // ここでセッションに値が入っているか確認


        // セッションに quest_id を保存
        // session(['quest_id' => $quest->id]);
        // セッションに quest_id を保存（URLには含めない）
        // session(['quest_id' => $quest->id]);

        // dd(route('quest.add', ['quest_id' => $quest->id]));
        // ⚡ 一旦リダイレクト → その後リフレッシュしても quest_id はURLに残らない
        // return redirect()->route('quest.add', ['quest_id' => $quest->id]);

        return response()->json(['quest_id' => $quest->id]); // ✅ これでJSONを返す
        
    } catch (\Exception $e) {
        return response()->json(['error' => '保存に失敗しました'], 500);
    }
    }

    public function getQuest($questId){

    $quest = Quest::find($questId);
    // dd($quest);
    if (!$quest) {
        return response()->json(['error' => 'Quest not found'], 404);
    }
    // dd($quest->main_image);
    return response()->json([
        'title' => $quest->title,
        'start_date' => $quest->start_date,
        'end_date' => $quest->end_date,
        'introduction' => $quest->introduction,
        'image_url' => $quest->main_image
    ]);
    }

    // CSRF Token
    public function refreshCsrfToken()
    {
        return response()->json([
            'csrf_token' => csrf_token()
        ]);
    }


    public function updateQuest(Request $request)
    {
        dd($request->all());  // リクエストの全データを確認
        $quest_id = $request->quest_id_hidden;
        dd($quest_id);
        $quest = Quest::find($quest_id);
        // dd($quest);
        if (!$quest) {
            return response()->json(['error' => 'Quest not found'], 404);
        }

        $quest->title = $request->title;
        $quest->start_date = $request->start_date;
        $quest->end_date = $request->end_date;
        $quest->introduction = $request->introduction;

        if ($request->hasFile('main_image')) {
            "data:main_image/".$request->main_image->extension().";base64,".base64_encode(file_get_contents($request->main_image));
        }

        $quest->save();

        return response()->json(['success' => true]);
    }



    public function storeQuestBody(Request $request){
        // dd(session()->all());
        // dd($request->all());
        
        try {
            $validated = $request->validate([
                'day_number' => 'required|integer',
                'spot_description' => 'required|string',
                'business_title' =>'nullable|max:30',
                'is_agenda' => 'nullable|in:0,1',
                'images.*' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd("🔥 バリデーションエラー:", $e->errors());
        }
        
    
        // 1️⃣ まずリクエストパラメータから `quest_id` を取得（編集ページから送られた場合）
        $quest_id = $request->input('quest_id');
    
        // 2️⃣ `quest_id` がリクエストにない場合（新規作成時）、セッションから取得
        // if (!$quest_id) {
        //     $quest_id = session('quest_id');
            
        // }
    
        // dd("🔥 QuestBody作成前", $quest_id);

        
        // QuestBody の保存
        $questbody = new QuestBody();
        $questbody->quest_id = $quest_id; // `quest_id` を設定
        // $questbody->spot_id = $request->spot_name->id ?? null; 
        // $questbody->business_id = $request->spot_name->id ?? null;
        $questbody->day_number = $request->day_number;
        $questbody->introduction = $request->spot_description;
        $questbody->business_title = $request->business_title;
        $questbody->is_agenda = $request->is_agenda ?? "1";

        // 🔥 どちらのテーブルか判定
        // dd($request->spot_business_id); // 型と値をチェック
        if ($request->spot_business_type === 'spot') {
            $questbody->spot_id = (int) $request->spot_business_id;
        } elseif ($request->spot_business_type === 'business') {
            $questbody->business_id = (int) $request->spot_business_id;
        }
        
        
        //image
        if ($request->hasFile('images')) {
            $imageDataList = [];
        
            foreach ($request->file('images') as $image) {
                // 🔥 Laravel 側で Base64 に変換
                $base64Image = "data:image/" . $image->extension() . ";base64," . base64_encode(file_get_contents($image));
        
                // 配列に追加
                $imageDataList[] = $base64Image;
            }
        
            // JSON で保存
            $questbody->image = json_encode($imageDataList);
        }

        // dd($questbody->toArray());

    
        $questbody->save();
    
        return redirect()->route('quest.add', ['quest_id' => $quest_id]);
    }

    public function searchAjax(Request $request)
{
    $query = $request->query('query');

    // Spot テーブルのデータ取得
    $spots = Spot::where('title', 'like', "%{$query}%")
                 ->select('id', 'title')
                 ->get()
                 ->map(function ($spot) {
                     return [
                         'id' => $spot->id,
                         'name' => $spot->title, // 一貫性のために `name` に統一
                         'type' => 'spot', // 🔥 ここで `type` を追加
                     ];
                 });

    // Business テーブルのデータ取得
    $businesses = Business::where('name', 'like', "%{$query}%")
                          ->select('id', 'name')
                          ->get()
                          ->map(function ($business) {
                              return [
                                  'id' => $business->id,
                                  'name' => $business->name,
                                  'type' => 'business', // 🔥 ここで `type` を追加
                              ];
                          });

    // データを結合して JSON で返す
    $results = $spots->merge($businesses);

    return response()->json($results);

}
    
    public function showAddQuest(){
        return view('quests.add-quest');
    }

    public function deleteQuest($id){
        // $this->post->destroy($id);
        $this->quest->findOrFail($id)->forceDelete();

        return redirect()->route('quest.add');
    }


// =============================================================Confirm Quest

public function showConfirmQuest($id)
{
    $quest_a = Quest::with(['questBodys'])->findOrFail($id);
// リレーションが null にならないようにデフォルトで空のコレクションを設定
$all_bodies = $quest_a->questBodies ?? collect(); 

// is_agenda = 1 のデータだけ
$agenda_bodys = $all_bodies->where('is_agenda', 1)->sortBy('day_number');

// 全てのデータ
$quest_bodys = $all_bodies->sortBy('day_number');

return view('quests.confirm-quest', compact('quest_a', 'agenda_bodys', 'quest_bodys'));
}

}