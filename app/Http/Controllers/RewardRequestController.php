<?php

// app/Http/Controllers/RewardRequestController.php
namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\RewardRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardRequestController extends Controller
{
    public function store(Request $request)
    {
        $rewardId = $request->input('reward_id');
        $user = Auth::user();

        // Check if reward exists
        $reward = Reward::find($rewardId);
        if (!$reward) {
            return back()->with('error', 'Reward not found!');
        }

        // Check if user has enough points
        if ($user->points < $reward->points) {
            return back()->with('error', 'Insufficient points!');
        }

        // Check if a pending request for the same reward already exists
        $existingRequest = RewardRequest::where('user_id', $user->id)
            ->where('reward_id', $reward->id)
            ->where('status', 'pending')
            ->first();
        if ($existingRequest) {
            return back()->with('error', 'You already have a pending request for this reward!');
        }

        // Create a new reward request
        $request = new RewardRequest;
        $request->user_id = $user->id;
        $request->user_tlp = $user->tlp;
        $request->reward_id = $reward->id;
        $request->save();

        // Reduce user points
        $user->reducePoints($reward->points);

        return back()->with('success', 'Reward request submitted successfully!');
    }

    // app/Http/Controllers/RewardRequestController.php
    public function update(Request $request, $id)
    {
        $status = $request->input('status'); // 'approved' or 'rejected'
        $request = RewardRequest::find($id);

        if (!$request) {
            return abort(404);
        }

        if ($status !== 'approved' && $status !== 'rejected') {
            return back()->with('error', 'Invalid status!');
        }

        $request->update(['status' => $status]);

        // If approved, give the user the reward
        if ($status === 'approved') {
            $user = $request->user;
            $reward = $request->reward;

            $user->addPoints($reward->points);
            $user->save();
        }

        return back()->with('success', 'Request updated successfully!');
    }

    // Additional methods for viewing request history, etc. (optional)
}