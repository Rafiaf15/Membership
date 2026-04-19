<?php

use App\Models\ActivityRule;
use App\Models\PointActivityLog;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // ========== DATA MODUL 1 (TIDAK BERUBAH) ==========
    $modul1 = [
        'stats' => [
            'activity_rules' => ActivityRule::query()->count(),
            'rewards' => Reward::query()->count(),
            'activity_logs' => PointActivityLog::query()->count(),
        ],
    ];

    // ========== DATA MODUL 3 (DITAMBAH) ==========
    $modul3 = [
        'stats' => [
            'total_users' => User::count(),
            'new_users_today' => User::whereDate('created_at', today())->count(),
            'total_points_earned' => PointActivityLog::where('points_earned', '>', 0)->sum('points_earned'),
            'total_points_redeemed' => abs(PointActivityLog::where('points_earned', '<', 0)->sum('points_earned')),
            'active_points' => PointActivityLog::where('point_status', 'active')
                ->where('expired_at', '>', now())
                ->sum('points_earned'),
            'points_expiring_soon' => PointActivityLog::where('point_status', 'active')
                ->where('expired_at', '<=', now()->addDays(30))
                ->where('expired_at', '>', now())
                ->sum('points_earned'),
        ],
    ];

    return view('welcome', compact('modul1', 'modul3'));
});