<?php

namespace App\Http\Controllers\Spot;

use Illuminate\Http\Request;
use App\Models\Spot;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{

    public function view($id)
    {
        $spot = Spot::findOrFail($id);
        return view('spots.spot')
            ->with('spot', $spot);
    }

    public function viewAddSpot($user_id)
    {
        // ユーザーIDをセッションに保存
        session(['spot_user_id' => $user_id]);
        
        \Log::debug('User ID saved to session:', ['user_id' => $user_id]);
        
        return view('spots.addspot');
    }

    public function confirmAddSpot(Request $request)
    {
        // GETリクエストの場合は入力画面にリダイレクト
        if ($request->isMethod('get')) {
            return redirect()->route('viewAddSpot');
        }

        $request->validate([
            'title' => 'required|max:255',
            'introduction' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'title.required' => 'スポットのタイトルを入力してください。',
            'introduction.required' => 'スポットの説明を入力してください。',
            'main_image.required' => 'メイン画像を選択してください。',
            'main_image.image' => 'メイン画像は画像ファイルを選択してください。',
            'main_image.mimes' => 'メイン画像はjpeg,png,jpg,gif形式のファイルを選択してください。',
            'main_image.max' => 'メイン画像は2MB以下のファイルを選択してください。',
            'photos.*.image' => '追加画像は画像ファイルを選択してください。',
            'photos.*.mimes' => '追加画像はjpeg,png,jpg,gif形式のファイルを選択してください。',
            'photos.*.max' => '追加画像は2MB以下のファイルを選択してください。'
        ]);

        // リクエストデータをログに出力
        \Log::debug('Request data:', [
            'title' => $request->title,
            'introduction' => $request->introduction,
            'has_main_image' => $request->hasFile('main_image'),
            'has_photos' => $request->hasFile('photos')
        ]);

        // 一時的に画像を保存
        $tempMainImage = null;
        $tempPhotos = [];

        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $tempMainImage = [
                'path' => $mainImage->store('temp/spots/main', 'public'),
                'name' => $mainImage->getClientOriginalName(),
                'url' => Storage::url('temp/spots/main/' . $mainImage->hashName())
            ];
            
            // メイン画像の情報をログに出力
            \Log::debug('Main image info:', $tempMainImage);
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoInfo = [
                    'path' => $photo->store('temp/spots/photos', 'public'),
                    'name' => $photo->getClientOriginalName(),
                    'url' => Storage::url('temp/spots/photos/' . $photo->hashName())
                ];
                $tempPhotos[] = $photoInfo;
                
                // 追加写真の情報をログに出力
                \Log::debug('Additional photo info:', $photoInfo);
            }
        }

        // セッションに確認用データを保存
        $confirmationData = [
            'title' => $request->title,
            'introduction' => $request->introduction,
            'main_image' => $tempMainImage,
            'photos' => $tempPhotos,
            'user_id' => session('spot_user_id') // セッションからユーザーIDを取得
        ];

        session(['spot_confirmation' => $confirmationData]);

        // セッションに保存したデータをログに出力
        \Log::debug('Session confirmation data:', $confirmationData);

        return view('spots.confirm-addspot');
    }

    public function storeSpot(Request $request)
    {
        // 確認画面からの送信でない場合はエラー
        if (!$request->has('confirmed')) {
            return redirect()->route('viewAddSpot')
                ->with('error', '不正なアクセスです。');
        }

        // セッションから確認済みデータを取得
        $confirmationData = session('spot_confirmation');
        if (!$confirmationData) {
            return redirect()->route('viewAddSpot')
                ->with('error', 'セッションが切れました。もう一度やり直してください。');
        }

        // セッションデータをログに出力
        \Log::debug('Spot store - Session data:', $confirmationData);

        try {
            // ディレクトリの存在確認と作成
            if (!Storage::exists('public/spots/main')) {
                Storage::makeDirectory('public/spots/main');
                \Log::debug('Created directory: public/spots/main');
            }
            
            if (!Storage::exists('public/spots/photos')) {
                Storage::makeDirectory('public/spots/photos');
                \Log::debug('Created directory: public/spots/photos');
            }

            // メイン画像を本番用ディレクトリに移動
            $mainImagePath = null;
            if (isset($confirmationData['main_image']) && $confirmationData['main_image']) {
                try {
                    $tempPath = $confirmationData['main_image']['path'];
                    $newPath = 'public/spots/main/' . basename($tempPath);
                    
                    // 画像パスの存在確認をログに出力
                    \Log::debug('Image path check:', [
                        'tempPath' => $tempPath,
                        'exists' => Storage::exists($tempPath),
                        'fullPath' => storage_path('app/public/' . $tempPath)
                    ]);
                    
                    if (Storage::exists($tempPath)) {
                        Storage::copy($tempPath, $newPath);
                        $mainImagePath = Storage::url($newPath);
                        \Log::debug('Image copied successfully:', [
                            'from' => $tempPath,
                            'to' => $newPath,
                            'url' => $mainImagePath
                        ]);
                    } else {
                        // 画像が見つからない場合、アップロード時のURLをそのまま使用
                        $mainImagePath = $confirmationData['main_image']['url'] ?? null;
                        \Log::warning('Main image not found, using original URL:', [
                            'originalPath' => $tempPath,
                            'url' => $mainImagePath
                        ]);
                    }
                } catch (\Exception $imageException) {
                    // 画像処理で例外が発生しても続行
                    \Log::error('Error processing main image: ' . $imageException->getMessage());
                    $mainImagePath = null;
                }
            }

            // 追加写真を本番用ディレクトリに移動
            $photoPaths = [];
            if (isset($confirmationData['photos']) && count($confirmationData['photos']) > 0) {
                foreach ($confirmationData['photos'] as $photo) {
                    try {
                        if (!isset($photo['path'])) continue;
                        
                        $tempPath = $photo['path'];
                        $newPath = 'public/spots/photos/' . basename($tempPath);
                        
                        \Log::debug('Additional photo check:', [
                            'photoPath' => $tempPath,
                            'exists' => Storage::exists($tempPath)
                        ]);
                        
                        if (Storage::exists($tempPath)) {
                            Storage::copy($tempPath, $newPath);
                            $photoPaths[] = Storage::url($newPath);
                        } else if (isset($photo['url'])) {
                            // 画像が見つからない場合、アップロード時のURLをそのまま使用
                            $photoPaths[] = $photo['url'];
                        }
                    } catch (\Exception $photoException) {
                        // 個別の写真で例外が発生しても続行
                        \Log::error('Error processing additional photo: ' . $photoException->getMessage());
                        continue;
                    }
                }
            }

            // スポットをデータベースに保存
            $spot = Spot::create([
                'title' => $confirmationData['title'],
                'introduction' => $confirmationData['introduction'],
                'main_image' => $mainImagePath,
                'photos' => $photoPaths,
                'user_id' => $confirmationData['user_id'] ?? null
            ]);

            \Log::debug('Spot created successfully:', [
                'id' => $spot->id,
                'title' => $spot->title,
                'mainImage' => $spot->main_image,
                'user_id' => $spot->user_id
            ]);

            // セッションをクリア
            session()->forget('spot_confirmation');

            return redirect()->route('viewSpot', ['id' => $spot->id])
                ->with('success', 'スポットが登録されました。');

        } catch (\Exception $e) {
            \Log::error('Spot creation error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            // 重大なエラーが発生した場合でも、基本的なスポット情報は保存を試みる
            try {
                $spot = Spot::create([
                    'title' => $confirmationData['title'],
                    'introduction' => $confirmationData['introduction'],
                    'main_image' => null,
                    'photos' => [],
                    'user_id' => $confirmationData['user_id'] ?? null
                ]);
                
                \Log::info('Spot created without images due to error:', [
                    'id' => $spot->id,
                    'title' => $spot->title
                ]);
                
                // セッションをクリア
                session()->forget('spot_confirmation');
                
                return redirect()->route('viewSpot', ['id' => $spot->id])
                    ->with('warning', 'スポットは登録されましたが、画像の処理中にエラーが発生しました。');
            } catch (\Exception $finalError) {
                \Log::critical('Failed to save spot even without images: ' . $finalError->getMessage());
                
                // 一時ファイルを削除
                if (isset($confirmationData['main_image'])) {
                    try {
                        Storage::delete($confirmationData['main_image']['path']);
                    } catch (\Exception $deleteError) {
                        \Log::warning('Failed to delete temp main image: ' . $deleteError->getMessage());
                    }
                }
                
                if (isset($confirmationData['photos'])) {
                    foreach ($confirmationData['photos'] as $photo) {
                        try {
                            Storage::delete($photo['path']);
                        } catch (\Exception $deleteError) {
                            \Log::warning('Failed to delete temp photo: ' . $deleteError->getMessage());
                        }
                    }
                }
                
                // 最終的なエラー時は入力画面に戻る
                return redirect()->route('viewAddSpot')
                    ->with('error', 'スポットの登録に失敗しました：' . $e->getMessage());
            }
        }
    }

    public function editSpot()
    {
        return view('spots.edit');
    }


}   
