<?php

// app/Http/Controllers/PointRedemptionController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\PointRedemption;

class PointRedemptionController extends Controller
{
    public function redeem(Request $request)
    {
        // Validasi request
        $request->validate([
            'reward_id' => 'required|exists:rewards,id'
        ]);
    
        // Logika penukaran poin
        $reward = Reward::find($request->reward_id);
        $user = auth()->user();
    
        if ($user->points >= $reward->points) {
            // Kurangi poin pengguna
            $user->points -= $reward->points;
            $user->save();
    
            // Create a new PointRedemption instance
            $pointRedemption = new PointRedemption();
            $pointRedemption->id = $user->id;
            $pointRedemption->reward_id = $reward->id;
            $pointRedemption->save();
    
            return response()->json(['status' => 'success', 'message' => 'Poin berhasil ditukar!']);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Poin tidak mencukupi!']);
    }

    public function getRedeemedRewards(Request $request)
{
    $user = auth()->user();
    $redeemedRewards = PointRedemption::where('id', $user->id)->get();

    return view('admin.rewards', compact('redeemedRewards'));
}
}