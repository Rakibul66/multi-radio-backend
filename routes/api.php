<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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

Route::get('/categories', [ApiController::class, 'categories']);

Route::get('/countries', [ApiController::class, 'countries']);

Route::get('/ads', [ApiController::class, 'ads']);


Route::post('radios', [ApiController::class, 'radios']);


Route::get('/schedule', [ApiController::class, 'schedule']);

Route::get('/social-media', [ApiController::class, 'socialMedia']);

Route::get('/podcast', [ApiController::class, 'podcast']);

//Route::get('/musics', [ApiController::class, 'musics']);

Route::post('user-register', [ApiController::class, 'userRegister']);

Route::post('user-login', [ApiController::class, 'userLogin']);

Route::post('top-videos', [ApiController::class, 'topVideos']);

Route::post('videos', [ApiController::class, 'videos']);

Route::middleware('auth:sanctum')->group( function () {
	Route::get('/musics', [ApiController::class, 'musics']);
	Route::post('user-logout', [ApiController::class, 'userLogout']);
});