<?php

Route::get('401', 'Errors@unauthorized');
Route::get('403', 'Errors@forbidden');
Route::get('404', 'Errors@notFound');
Route::get('500', 'Errors@internalError');
Route::get('503', 'Errors@serviceUnavailable');

Route::post('internal/ci-build-notifier', 'Internal@ciBuildNotifier');
Route::post('internal/telegram/webhook', 'Internal@telegramWebhook');

Route::get('ip', function () { return \Request::ip(); });

Route::get('resize/{width}x{height}', 'Resize@image');

Route::get('cv', 'Home@cv');
Route::get('parser/fl/{login}/{passwd}', 'ParserFl@index');
