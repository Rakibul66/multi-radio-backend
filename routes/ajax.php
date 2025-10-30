<?php
 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\AjaxController;

 //ajax requests
 
 Route::post('category-status-update', [AjaxController::class, 'categoryStatusUpdate']);

 Route::post('country-status-update', [AjaxController::class, 'countryStatusUpdate']);

 Route::post('radio-status-update', [AjaxController::class, 'radioStatusUpdate']);

 Route::post('music-status-update', [AjaxController::class, 'musicStatusUpdate']);