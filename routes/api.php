<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\FooterController;
use App\Http\Controllers\API\NoticeController;
use App\Http\Controllers\API\GallaryController;
use App\Http\Controllers\API\FooterLogoController;
use App\Http\Controllers\API\NewsAndEventController;

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
// For News and Event
Route::get('index/news', [NewsAndEventController:: class, 'index']);
Route::post('updateOrAdd/news', [NewsAndEventController:: class, 'updateOrAddnews']);
Route::delete('delete/news', [NewsAndEventController:: class, 'delete']);

// For Notice
Route::get('index/notice', [NoticeController::class, 'index']);
Route::post('updateOrAdd/notice', [NoticeController::class, 'UpdateOrAddNotice']);
Route::delete('delete/notice', [NoticeController::class, 'delete']);

// For Gallary
Route::get('index/gallary', [GallaryController::class, 'index']);
Route::post('updateOrAdd/gallary', [GallaryController::class, 'UpdateOrAddGallary']);
Route::delete('delete/gallary', [GallaryController::class, 'delete']);

// For Banner
Route::get('index/banner', [BannerController::class, 'index']);
Route::post('updateOrAdd/banner', [BannerController::class, 'UpdateOrAddBanner']);
Route::delete('delete/banner', [BannerController::class, 'delete']);


// For Footer
Route::get('index/footer', [FooterController::class, 'index']);
Route::post('updateOrAdd/footer', [FooterController::class, 'UpdateOrAddFooter']);
Route::delete('delete/footer', [FooterController::class, 'delete']);

// For Footer Section
Route::get('index/footer/logo', [FooterLogoController::class, 'index']);
Route::post('updateOrAdd/footer/logo', [FooterLogoController::class, 'UpdateOrAddFooterLogo']);
Route::delete('delete/footer/logo', [FooterLogoController::class, 'delete']);

