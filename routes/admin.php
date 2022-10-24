<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JudgeController;
use App\Http\Controllers\Admin\ContestantController;
use App\Http\Controllers\Admin\DashboardController;

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
// Route::post('/upload-image', [ImagesController::class,'addImage']);
