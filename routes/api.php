<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BasicInformationController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\ContestantAttemptController;
use App\Http\Controllers\AttemptController;
use App\Http\Controllers\JudgeWordsController;
use App\Http\Controllers\WordsController;
use App\Http\Controllers\ContestantLabels;
use App\Http\Controllers\LabelsController;
use App\Http\Controllers\LabelMakerController;
use App\Http\Controllers\UserAllDetailsController;
use App\Http\Controllers\WordAttemptsController;

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
Route::apiResource('/user-all-details',UserAllDetailsController::class);
Route::get('/judge-all-details/{id}', [UserAllDetailsController::class,'judgeAllDetails']);
Route::get('/contestant-all-details/{id}', [UserAllDetailsController::class,'contestantAllDetails']);


Route::apiResource('/contestant-attempt',ContestantAttemptController::class);
Route::apiResource('/attempt',AttemptController::class);
Route::apiResource('/word-attempts',WordAttemptsController::class);

Route::apiResource('/judge-words',JudgeWordsController::class);
Route::apiResource('/word',WordsController::class);
Route::post('/words-filtered', [WordsController::class,'getWordsWithFilter']);


Route::apiResource('/contestant-labels',ContestantLabels::class);
Route::apiResource('/labels',LabelsController::class);
Route::apiResource('/make-label',LabelMakerController::class);
