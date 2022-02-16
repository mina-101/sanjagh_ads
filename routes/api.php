<?php

use \App\Http\Controllers\AdController;
use \App\Http\Controllers\CampaignController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\UserGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function() {
    Route::resource('campaigns/{campaignId}/ads', AdController::class)->only(["store", "index"]);
    Route::post('campaigns/{campaignId}/activate', [CampaignController::class, 'activate']);
    Route::resource('campaigns', CampaignController::class)->only(["store", "index"]);
    Route::resource('userGroup', UserGroupController::class)->only(["store"]);
});
Route::post('login' , [UserController::class, 'login']);
Route::post('register' , [UserController::class, 'register']);
