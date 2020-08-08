<?php

use App\Http\Controllers;

Route::view('401', 'errors.401');
Route::view('403', 'errors.403');
Route::view('404', 'errors.404');
Route::view('500', 'errors.500');
Route::view('503', 'errors.503');

Route::post('ajax/beacon', Controllers\Beacon::class);
Route::get('cv', Controllers\Cv::class);

Route::post('internal/ci-build-notifier', Ivacuum\Generic\Controllers\CiBuildNotifyController::class);
Route::post('internal/telegram/webhook', Ivacuum\Generic\Controllers\TelegramWebhookController::class);

Route::get('ip', Ivacuum\Generic\Controllers\PrintIpController::class);
Route::get('parser/fl/{login}/{passwd}', Controllers\ParserFlController::class);
Route::get('resize/{width}x{height}', Controllers\ResizeImage::class);
