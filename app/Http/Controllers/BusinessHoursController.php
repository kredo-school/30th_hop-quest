<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessHour; 

class BusinessHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businessHours = BusinessHour::where('business_id', request('business_id'))->get();
        return view('business_hours.index', compact('businessHours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('business_hours.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'business_hours' => 'required|array',
        ]);

        $businessId = $request->input('business_id');
        $businessHoursData = $request->input('business_hours');

        foreach ($businessHoursData as $day => $hours) {
            // ここを1と0に変更（2と1ではなく）
            $is_closed = isset($hours['is_closed']) ? 1 : 0; // 1=閉店, 0=営業中
            
            BusinessHour::create([
                'business_id' => $businessId,
                'day_of_week' => $day,
                'opening_time' => $hours['opening_time'] ?? null,
                'closing_time' => $hours['closing_time'] ?? null,
                'is_closed' => $is_closed,
                'break_start' => $hours['break_start'] ?? null,
                'break_end' => $hours['break_end'] ?? null,
                'notice' => $hours['notice'] ?? null,
            ]);
        }

        return redirect()->route('businesses.show', $businessId)
            ->with('success', 'Business hours have been saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $businessHours = BusinessHour::where('business_id', $id)
            ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get();
        
        return view('business_hours.show', compact('businessHours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $businessHours = BusinessHour::where('business_id', $id)
            ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get()
            ->keyBy('day_of_week');
        
        return view('business_hours.edit', compact('businessHours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'business_hours' => 'required|array',
        ]);

        $businessHoursData = $request->input('business_hours');
        
        // 一度該当のビジネスの営業時間をすべて削除
        BusinessHour::where('business_id', $id)->delete();
        
        // 新しいデータを挿入
        foreach ($businessHoursData as $day => $hours) {
            // ここも1と0に変更
            $is_closed = isset($hours['is_closed']) ? 1 : 0; // 1=閉店, 0=営業中
            
            BusinessHour::create([
                'business_id' => $id,
                'day_of_week' => $day,
                'opening_time' => $hours['opening_time'] ?? null,
                'closing_time' => $hours['closing_time'] ?? null,
                'is_closed' => $is_closed,
                'break_start' => $hours['break_start'] ?? null,
                'break_end' => $hours['break_end'] ?? null,
                'notice' => $hours['notice'] ?? null,
            ]);
        }

        return redirect()->route('businesses.show', $id)
            ->with('success', 'Business hours have been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BusinessHour::where('business_id', $id)->delete();
        
        return redirect()->route('businesses.index')
            ->with('success', 'Business hours have been deleted successfully!');
    }
}