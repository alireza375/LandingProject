<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultiyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InspirationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//inspiration
Route::post('/create-inspiration', [InspirationController::class, 'storeUpdateInspiration']);
//Route::post('/update-inspiration', [InspirationController::class, 'update']);
Route::get('/index/list', [InspirationController::class, 'index']);
Route::get('/inspiration/{id?}', [InspirationController::class, 'show']);
Route::delete('/delete', [InspirationController::class, 'delete']);

//inspirationCard
Route::get('/index/list',[CardController::class, "index"]);
Route::post('/createOrUpdate-card',[CardController::class, "updateOrcreate"]);
Route::delete('/delete/card',[CardController::class, "delete"]);
Route::get('/show/{id?}',[CardController::class, "show"]);

//course
Route::get('/index/courseList',[CourseController::class,'index']);
Route::get('/show/courseList/{id?}',[CourseController::class,'show']);
Route::post('/updateOrCreate',[CourseController::class,'updateOrcreateCourse']);
Route::delete('/delete/course',[CourseController::class,'delete']);

//Faculty
Route::get('/index/facultyList',[FacultiyController::class, 'index']);
Route::get('/show/faculty',[FacultiyController::class, 'show']);
Route::post('/updateOrCreate',[FacultiyController::class, 'updateOrCreateFaculty']);
Route::delete('/delete/faculty',[FacultiyController::class, 'delete']);
    
    