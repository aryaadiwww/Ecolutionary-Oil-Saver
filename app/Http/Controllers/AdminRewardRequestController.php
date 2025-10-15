<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RewardRequest;
use Illuminate\Http\Request;

class AdminRewardRequestController extends Controller
{
    public function index()
    {
        $pendingRequests = RewardRequest::where('status', 'pending')->get();
        return view('admin.rewards', [
            'title' => 'Admin | Manage Rewards',
            'requests' => $pendingRequests
        ]);
    }

    public function update(Request $request, $id)
    {
        $rewardRequest = RewardRequest::findOrFail($id);

        $action = $request->input('action');

        if ($action === 'approve') {
            $rewardRequest->update(['status' => 'approved']);
            $message = 'Reward request approved successfully.';
        } elseif ($action === 'reject') {
            $rewardRequest->update(['status' => 'rejected']);
            // Return points to the user
            $user = $rewardRequest->user;
            $user->points += $rewardRequest->reward->points;
            $user->save();
            $message = 'Reward request rejected and points returned successfully.';
        } else {
            return redirect()->back()->with('error', 'Invalid action.');
        }

        return redirect()->back()->with('success', $message);
    }
}