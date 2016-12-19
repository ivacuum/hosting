<?php

Route::get('/', 'Home@index');
Route::get('auth/login', 'Auth@login')->middleware('guest');
Route::post('auth/login', 'Auth@loginPost')->middleware('guest');
Route::get('auth/logout', 'Auth@logout')->middleware('auth');
Route::get('auth/register', 'Auth@register')->middleware('guest');
Route::post('auth/register', 'Auth@registerPost')->middleware('guest');
Route::get('auth/register/confirm/{token}', 'Auth@registerConfirm')->middleware('guest');
Route::get('auth/register/ok', 'Auth@registerOk')->middleware('guest');
Route::get('auth/password/remind', 'Auth@passwordRemind')->middleware('guest');
Route::post('auth/password/remind', 'Auth@passwordRemindPost')->middleware('guest');
Route::get('auth/password/reset/{token}', 'Auth@passwordReset')->middleware('guest');
Route::post('auth/password/reset', 'Auth@passwordResetPost')->middleware('guest');

Route::post('ajax/feedback', 'Ajax@feedback');

Route::get('about', 'Home@about');
Route::get('docs', 'Docs@index');
Route::get('docs/{page}', 'Docs@page');
Route::get('life', 'Life@index');
Route::get('life/cities', 'Life@cities');
Route::get('life/countries', 'Life@countries');
Route::get('life/countries/{country}', 'Life@country');
Route::get('life/gigs', 'Life@gigs');
Route::get('life/{page}', 'Life@page');

Route::get('parser/vk/{page?}/{date?}', 'ParserVk@index')
    ->where('date', '\d{4}-\d{2}-\d{2}');
Route::post('parser/vk', 'ParserVk@indexPost');

Route::get('torrents', 'Torrents@index');
Route::post('torrents', 'Torrents@addPost')->middleware('auth');
Route::get('torrents/add', 'Torrents@add')->middleware('auth');
Route::get('torrents/faq', 'Torrents@faq');
Route::get('torrents/{Torrent}', 'Torrents@torrent');
