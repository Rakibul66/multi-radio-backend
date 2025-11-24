<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RadioController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\VideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'loginPage']);

Route::post('admin-login', [AccessController::class, 'adminLogin']);

Route::get('/logout', [AccessController::class, 'Logout']);


Route::group(['middleware' => 'prevent-back-history'],function(){
  
  //admin dashboard

  Route::get('/dashboard', [DashboardController::class, 'Dashboard']);

  //categories

  Route::resource('categories', CategoryController::class);

  //countries

  Route::resource('countries', CountryController::class);

  //Social Media
  Route::resource('socialmedia', SocialMediaController::class);

  //Schedule
  Route::resource('schedule', ScheduleController::class);

  //podcast
  Route::resource('podcast',PodcastController::class);

 //radios
  Route::resource('radios', RadioController::class);

 //musics
  Route::resource('musics', MusicController::class);

 //videos
  Route::resource('videos', VideoController::class);


  //settings

  Route::get('/app-settings', [SettingController::class, 'appSettings']);

  Route::get('/ads-settings', [SettingController::class, 'adsSettings']);

  Route::post('settings-ads', [SettingController::class, 'settingAds']);
  
  Route::post('settings-app', [SettingController::class, 'settingsApp']);

  Route::get('/account-settings', [SettingController::class, 'accountSettings']);
  
  Route::post('settings-account', [SettingController::class, 'settingsAccount']);

  Route::get('/change-password', [SettingController::class, 'changePassword']);

  Route::post('password-change', [SettingController::class, 'passwordChange']);

});