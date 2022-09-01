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
use App\Http\Controllers\PerformersController;
use App\Http\Controllers\AppVersionController;
use App\Http\Controllers\LabelDetailsController;
use App\Http\Controllers\ContestantStatisticsController;
use App\Http\Controllers\BugReportController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\BugCommentsController;
use App\Http\Controllers\ViolationsController;


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
Route::apiResource('/categories',CategoriesController::class);
Route::apiResource('/judge',JudgeController::class);
Route::apiResource('/bug-comments',BugCommentsController::class);
Route::apiResource('/user-all-details',UserAllDetailsController::class);
Route::post('/upload-image', [ImagesController::class,'addImage']);
Route::get('/judge-all-details/{id}', [UserAllDetailsController::class,'judgeAllDetails']);
Route::get('/contestant-all-details/{id}', [UserAllDetailsController::class,'contestantAllDetails']);


Route::apiResource('/contestant-attempt',ContestantAttemptController::class);
Route::apiResource('/attempt',AttemptController::class);
Route::apiResource('/word-attempts',WordAttemptsController::class);


Route::apiResource('/judge-words',JudgeWordsController::class);
Route::apiResource('/word',WordsController::class);
Route::post('/words-filtered', [WordsController::class,'getWordsWithFilter']);

Route::apiResource('/version',AppVersionController::class);
Route::apiResource('/bug-report',BugReportController::class);
Route::apiResource('/changelogs',ChangelogController::class);

Route::apiResource('/contestant-labels',ContestantLabels::class);
Route::apiResource('/labels',LabelsController::class);
Route::apiResource('/make-label',LabelMakerController::class);
Route::post('/judge-specific-lables', [LabelsController::class,'judgeSpecificLabels']);
Route::post('/judge-specific-label-details', [LabelDetailsController::class,'judgeSpecificLabelDetails']);
Route::post('/global-label-details', [LabelDetailsController::class,'globalLabelDetails']);

Route::get('/judge-performers/{id}', [PerformersController::class,'getJudgePerformers']);
Route::get('/judge-top-performers/{id}', [PerformersController::class,'getJudgeTopPerformers']);
Route::get('/word-top-performers/{id}', [PerformersController::class,'wordTopPerformers']);

Route::post('/contestant-statistics-for-judge', [ContestantStatisticsController::class,'getStatisticsForJudge']);
Route::post('/contestant-statistics-global', [ContestantStatisticsController::class,'getStatisticsGlobal']);

// Added
Route::get('/totalJudges', [UserAllDetailsController::class,'judgeCount']);
Route::get('/totalContestants', [UserAllDetailsController::class,'ContestantCount']);
Route::get('/judge-basic-info',[JudgeController::class,'judgeBasicInfo']);
Route::get('/contestant-basic-info',[ContestantController::class,'contestantBasicInfo']);
Route::get('/check-violation',[JudgeWordsController::class,'hasViolations']);
Route::get('/all-judges-violation-details',[ViolationsController::class,'getViolationDetails']);
Route::get('/all-judges-violation-details/{id}',[ViolationsController::class,'getViolationDetailsById']);
Route::get('/judge-violation-info',[ViolationsController::class,'getViolationInfo']);