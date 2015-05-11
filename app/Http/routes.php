<?php

Route::get('/', 'Home@index');
Route::get('auth/login', 'Auth@login');
Route::post('auth/login', 'Auth@loginPost');
Route::get('auth/logout', 'Auth@logout');
Route::get('auth/register', 'Auth@register');
Route::post('auth/register', 'Auth@registerPost');
Route::get('auth/register/confirm/{token}', 'Auth@registerConfirm');
Route::get('auth/register/ok', 'Auth@registerOk');
Route::get('auth/password/remind', 'Auth@passwordRemind');
Route::post('auth/password/remind', 'Auth@passwordRemindPost');
Route::get('auth/password/reset/{token}', 'Auth@passwordReset');
Route::post('auth/password/reset', 'Auth@passwordResetPost');

Route::get('about', 'Home@about');
Route::get('cv', 'Home@cv');
Route::get('life', 'Life@index');
Route::get('life/{page}', 'Life@page');

Route::get('parser/vk/{page?}/{date?}', 'ParserVk@index')
	->where('date', '\d{4}-\d{2}-\d{2}');
