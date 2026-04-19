<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActivityRuleController;
use App\Http\Controllers\Api\RewardController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\StatementController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['jwt.auth'])->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // Statement & Points
    Route::get('/statement', [StatementController::class, 'index']);
    Route::get('/statement/export-pdf', [StatementController::class, 'exportPdf']);
    Route::get('/points/balance', [StatementController::class, 'balance']);
});

Route::apiResource('activity-rules', ActivityRuleController::class)->except(['show']);
Route::apiResource('rewards', RewardController::class)->except(['show']);
Route::post('rewards/{reward}/decrement-stock', [RewardController::class, 'decrementStock']);
Route::post('/activity/trigger', [ActivityRuleController::class, 'trigger']);