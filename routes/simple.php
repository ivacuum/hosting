<?php

Route::view('401', 'errors.401');
Route::view('403', 'errors.403');
Route::view('404', 'errors.404');
Route::view('500', 'errors.500');
Route::view('503', 'errors.503');

Route::post('ajax/beacon', 'Beacon');

Route::post('internal/ci-build-notifier', 'Internal@ciBuildNotifier');
Route::post('internal/telegram/webhook', 'Internal@telegramWebhook');

Route::get('ip', 'Internal@ip');

Route::get('resize/{width}x{height}', 'Resize@image');

Route::get('cv', 'Home@cv');
Route::get('parser/fl/{login}/{passwd}', 'ParserFl@index');
