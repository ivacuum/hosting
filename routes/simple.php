<?php

use App\Http\Controllers;

Route::view('401', 'errors.401');
Route::view('403', 'errors.403');
Route::view('404', 'errors.404');
Route::view('500', 'errors.500');
Route::view('503', 'errors.503');

Route::view('cv', 'cv');
Route::get('ip', Controllers\PrintIpController::class);
Route::post('js/beacon', Controllers\BeaconController::class);
Route::get('resize/{width}x{height}', Controllers\ResizeImage::class);
Route::post('telegram/webhook', Controllers\TelegramWebhookController::class);
