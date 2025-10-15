<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorLaravel;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OilTestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\RewardRequestController;
use App\Http\Controllers\PointRedemptionController;
use App\Http\Controllers\AdminRewardRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'title'=> 'Ecolutionary Oil Saver',
        'desc'=> 'EOS (Ecolutionary Oil Saver) is created with the hope of making a real contribution to reducing environmental pollution by decreasing carbon footprint and household waste, and raising awareness among the public about environmental conservation efforts, particularly in the use of used cooking oil.'
    ]);
});

Route::post('/rewards/request', [RewardRequestController::class, 'store'])->name('reward.requests');

// Hardware Page
Route::get('/sensor', function (){
    return view('monitoring');
});

Route::get('/bacakode', [SensorLaravel::class,'bacakode']);
Route::get('/bacasuhu', [SensorLaravel::class,'bacasuhu']);
Route::get('/bacawarna', [SensorLaravel::class,'bacawarna']);
Route::get('/bacatds', [SensorLaravel::class, 'bacatds']);
// Route::get('/simpan/{kodemember}/{nilaisuhu}/{nilaiwarna}/{nilaitds}', [SensorLaravel::class,'simpansensor']);
// Route::get('/simpan/{nilaisuhu}/{nilaiwarna}/{nilaitds}', [SensorLaravel::class,'simpansensor']);
Route::get('/simpan/{kodemember}/{nilaisuhu}/{nilaiwarna}/{nilaitds}', [SensorLaravel::class,'simpansensor']);

// Optionally, handle POST requests for better security
Route::post('/simpan', [SensorLaravel::class, 'simpansensorPost']);

// Admin Page
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/admin/report', [AdminController::class, 'report'])->name('report');
    Route::get('/admin/member', [AdminController::class, 'member'])->name('member');
    Route::get('/admin/rewards', [AdminRewardRequestController::class, 'index'])->name('rewards');
    Route::put('/admin/reward-requests/{id}', [AdminRewardRequestController::class, 'update'])->name('admin.reward-requests.update');
});

// User Page
Route::middleware('guest')->group(function(){
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'login'])->name('req.login');
    Route::get('/register', [SessionController::class, 'signup'])->name('register');
    Route::post('/register', [SessionController::class, 'create'])->name('req.register');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/logout', [SessionController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/redeem', [PointRedemptionController::class, 'redeem'])->name('redeem');
    Route::get('/settings', [UserController::class, 'edit'])->name('update');
    Route::post('/settings/update', [UserController::class, 'update'])->name('user.update');
});