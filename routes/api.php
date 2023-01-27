<?php

use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\EmployementController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\WorkingExperienceController;
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


Route::apiResource('profile', ProfileController::class);
Route::apiResource('working-experience', WorkingExperienceController::class);

Route::post('employment/{employement}', [EmployementController::class, 'store']);
Route::apiResource('employment', EmployementController::class);

Route::post('education/{education}', [EducationController::class, 'store']);
Route::apiResource('education', EducationController::class);

Route::post('skill/{skill}', [SkillController::class, 'store']);
Route::apiResource('skill', SkillController::class);

Route::apiResource('photo', PhotoController::class);
