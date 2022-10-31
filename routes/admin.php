<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JudgeController;
use App\Http\Controllers\Admin\ContestantController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\ViolationsController;

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

Route::apiResource('/judge',JudgeController::class);
Route::apiResource('/contestant',ContestantController::class);
Route::apiResource('/dashboard',DashboardController::class);
//Route::get('/upload-image', [ImagesController::class,'addImage']);
Route::get('/judge-violation-details/{id}',[ViolationsController::class,'getViolationDetailsById']);
Route::get('/judges-violation-info',[ViolationsController::class,'getViolationInfo']);
Route::post('/post-judge-notification', [NotificationsController::class,'postJudgeNotification']);