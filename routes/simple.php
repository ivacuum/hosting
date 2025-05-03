<?php

use App\Http\Controllers;

Route::view('401', 'errors.401', status: 401);
Route::view('403', 'errors.403', status: 403);
Route::view('404', 'errors.404', status: 404);
Route::view('500', 'errors.500', status: 500);
Route::view('503', 'errors.503', status: 503);

Route::view('cv', 'cv');
Route::get('ip', Controllers\PrintIpController::class);
Route::post('js/beacon', Controllers\BeaconController::class);
Route::get('resize/{width}x{height}/{domain}/{path}', Controllers\ResizeImageController::class)->where('path', '.+');
Route::post('telegram/webhook', Controllers\TelegramWebhookController::class);
