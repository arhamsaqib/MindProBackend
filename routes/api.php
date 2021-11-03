<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BasicInformationController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\JudgeController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('/user',UserController::class);
Route::apiResource('/basic-information',BasicInformationController::class);
Route::apiResource('/contestant',ContestantController::class);
Route::apiResource('/judge',JudgeController::class);
