<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MSensor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SensorLaravel extends Controller
{
    public function bacakode()
    {
        $sensor = MSensor::all();
        return view('bacakode', ['nilaisensor'=> $sensor]);
    }
    public function bacasuhu()
    {
        $sensor = MSensor::all();
        return view('bacasuhu', ['nilaisensor'=> $sensor]);
    }
    public function bacawarna()
    {
        $sensor = MSensor::all();
        return view('bacawarna', ['nilaisensor'=> $sensor]);
    }
    public function bacatds()
    {
        $sensor = MSensor::all();
        return view('bacatds', ['nilaisensor'=> $sensor]);
    }
    
    // public function simpansensor(Request $request)
    // {
    //     // MSensor::where('id',1)->update(['kodemember' => request()->kodemember, 'suhu' => request()->nilaisuhu, 'warna' => request()->nilaiwarna, 'tds' => request()->nilaitds]);
    //     MSensor::where('id',1)->update(['suhu' => request()->nilaisuhu, 'warna' => request()->nilaiwarna, 'tds' => request()->nilaitds]);
    // }
    
    // public function simpansensor($kodemember, $nilaisuhu, $nilaiwarna, $nilaitds)
    // {
    //     $berat_ml = $nilaisuhu;

    //     $poin = ($berat_ml / 1000) * 0.8;

    //     MSensor::where('id', 1)->update([
    //         'kodemember'=> $kodemember,
    //         'suhu' => $berat_ml,
    //         'warna' => $nilaiwarna,
    //         'tds' => $nilaitds,
    //     ]);

    //     // Update user
    //     $user = User::where('id', $kodemember)->first();
    //     if ($user) {
    //         $user->ml = intval($user->ml) + $berat_ml;
    //         $user->warna = $nilaiwarna;
    //         $user->tds = $nilaitds;
    //         $user->points = floatval($user->points) + $poin;
    //         $user->save();

    //         // return response()->json(['success' => 'Data berhasil disimpan dan diperbarui di tabel user.']);
    //     }
    //     // return response()->json(['error' => 'User tidak ditemukan.'], 404);
    // }

    public function simpansensor($kodemember, $nilaisuhu, $nilaiwarna, $nilaitds)
    {
        $berat_ml = $nilaisuhu;
        $poin = ($berat_ml / 1000) * 0.8;

        MSensor::where('id', 1)->update([
            'kodemember' => $kodemember,
            'suhu' => $berat_ml,
            'warna' => $nilaiwarna,
            'tds' => $nilaitds,
        ]);

        $user = User::where('id', $kodemember)->first();
        if ($user) {
            $user->ml += $berat_ml;
            $user->warna = $nilaiwarna;
            $user->tds = $nilaitds;
            $user->points += $poin;
            $user->save();
        }
    }

    public function simpansensorPost(Request $request)
    {
        $kodemember = $request->input('kodemember');
        $nilaisuhu = $request->input('nilaisuhu');
        $nilaiwarna = $request->input('nilaiwarna');
        $nilaitds = $request->input('nilaitds');

        return $this->simpansensor($kodemember, $nilaisuhu, $nilaiwarna, $nilaitds);
    }
}