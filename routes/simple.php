<?php

Route::get('401', 'Errors@unauthorized');
Route::get('403', 'Errors@forbidden');
Route::get('404', 'Errors@notFound');
Route::get('500', 'Errors@internalError');
Route::get('503', 'Errors@serviceUnavailable');

Route::get('cv', 'Home@cv');
Route::get('parser/fl/{login}/{passwd}', 'ParserFl@index');
