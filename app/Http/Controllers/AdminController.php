<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RewardRequest;
use App\Models\Reward;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $data = $this->getOilData();
        // Menghitung total anggota yang bukan admin
        $totalMembers = User::where('is_admin', false)->count();
        $data['totalMembers'] = $totalMembers;

        return view('admin.dashboard', compact('data'), [
            'title' => 'Admin | Dashboard',
        ]);
    }

    public function getOilData()
    {
        $totalValue = User::sum('ml');

        // Menghitung total ml untuk hari ini
        $harianValue = User::whereDate('created_at', Carbon::today())->sum('ml');

        // Menghitung total ml untuk bulan ini
        $bulananValue = User::whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->sum('ml');

        // Menghitung total poin yang dikeluarkan dari reward requests yang disetujui
        $totalSpentPoints = RewardRequest::where('status', 'approved')
                            ->join('rewards', 'reward_requests.reward_id', '=', 'rewards.id')
                            ->sum('rewards.points');

        // Menghitung jumlah user yang melakukan setoran hari ini
        $todayDepositors = User::whereDate('updated_at', Carbon::today())->count();

        $totalLimit = 15000;
        $totalCollected = $totalValue;
        $overallPercentage = $this->calculatePercentage($totalCollected, $totalLimit);

        $data = [
            'totalValue' => $totalValue,
            'harianValue' => $harianValue,
            'bulananValue' => $bulananValue,
            'totalLimit' => $totalLimit,
            'totalCollected' => $totalCollected,
            'overallPercentage' => $overallPercentage,
            'totalPercentage' => $this->calculatePercentage($totalValue, $totalLimit),
            'harianPercentage' => $this->calculatePercentage($harianValue, $totalLimit),
            'bulananPercentage' => $this->calculatePercentage($bulananValue, $totalLimit),
            'totalSpentPoints' => $totalSpentPoints,
            'todayDepositors' => $todayDepositors,
        ];

        return $data;
    }

    private function calculatePercentage($value, $total)
    {
        return number_format(($value / $total) * 100, 1) . '%';
    }

    public function member()
    {
        $data = User::paginate(5);
        return view('admin.member', [
            'title' => 'Admin | Manage Member',
            'data'  => $data,
        ]);
    }

    public function report()
    {
        $data = $this->getOilData();
        return view('admin.report', compact('data'), [
            'title' => 'Admin | Manage Report',
        ]);
    }
}