<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JudgeController;
use App\Http\Controllers\Admin\ContestantController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\ViolationsController;
use App\Http\Controllers\Admin\WarningsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\BasicInformationController;
use App\Http\Controllers\UserController;

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

Route::post('/register', [AdminAuthController::class,'register']);
Route::post('/login', [AdminAuthController::class,'login']);
Route::post('/signout', [AdminAuthController::class,'signout']);


// Route::middleware('auth:api')->group(function () {
// });
    
        Route::apiResource('/basic-information',BasicInformationController::class);
        Route::apiResource('/judge',JudgeController::class);
        Route::apiResource('/contestant',ContestantController::class);
        Route::apiResource('/dashboard',DashboardController::class);
        //Route::get('/upload-image', [ImagesController::class,'addImage']);
        Route::get('/judge-violation-details/{id}',[ViolationsController::class,'getViolationDetailsById']);
        Route::get('/judges-violation-info',[ViolationsController::class,'getViolationInfo']);
        Route::get('/fetch-violation-count/{id}',[ViolationsController::class,'getViolationCount']);
        Route::post('/post-judge-notification', [NotificationsController::class,'postJudgeNotification']);
        Route::post('/post-judge-warning', [WarningsController::class,'postJudgeWarning']);
        Route::get('/fetch-user-feedback/{uid}', [FeedbackController::class,'fetchUserFeedback']);
        Route::get('/contestant-stat-details/{cid}', [ContestantController::class,'contestantStatDetails']);
        Route::post('/change-user-status', [UserController::class,'changeUserStatus']);
    
    