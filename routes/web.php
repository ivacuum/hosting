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

// OAuth
Route::get('auth/facebook', 'Auth\Facebook@index');
Route::get('auth/facebook/callback', 'Auth\Facebook@callback');
Route::get('auth/google', 'Auth\Google@index');
Route::get('auth/google/callback', 'Auth\Google@callback');
Route::get('auth/vk', 'Auth\Vk@index');
Route::get('auth/vk/callback', 'Auth\Vk@callback');

Route::post('ajax/comment/{type}/{id}', 'Ajax@comment')->middleware('auth');
// Route::post('ajax/feedback', 'Ajax@feedback');

Route::get('about', 'Home@about');

Route::get('dc', 'Dcpp@index');
Route::get('dc/{page}', 'Dcpp@page');

Route::get('docs', 'Docs@index');
Route::get('docs/{page}', 'Docs@page');

Route::get('files/{File}/dl', 'Files@download');

Route::get('gallery', 'Gallery@index')->middleware('auth');
Route::get('gallery/preview/{Image}', 'Gallery@preview');
Route::get('gallery/view/{Image}', 'Gallery@view');
Route::get('gallery/upload', 'Gallery@upload')->middleware('auth');
Route::post('gallery/upload', 'Gallery@uploadPost')->middleware('auth');

Route::get('life', 'Life@index');
Route::get('life/cities', 'Life@cities');
Route::get('life/countries', 'Life@countries');
Route::get('life/countries/{country}', 'Life@country');
Route::get('life/gigs', 'Life@gigs');
Route::get('life/{page}', 'Life@page');

Route::get('my', 'My@index')->middleware('auth');
Route::get('my/password', 'My@password')->middleware('auth');
Route::put('my/password', 'My@passwordPut')->middleware('auth');
Route::get('my/profile', 'My@profile')->middleware('auth');
Route::put('my/profile', 'My@profilePut')->middleware('auth');

Route::get('news', 'News@index');
Route::get('news/{id}', 'News@show');
Route::get('news/{year}/{month}', 'News@bc');
Route::get('news/{year}/{month}/{day}', 'News@bc');
Route::get('news/{year}/{month}/{day}/{slug}', 'News@bc');

Route::get('notifications', 'Notifications@index')->middleware('auth');

Route::get('parser/vk/{page?}/{date?}', 'ParserVk@index')->where('date', '\d{4}-\d{2}-\d{2}');
Route::post('parser/vk', 'ParserVk@indexPost');

Route::get('retracker', 'Retracker@index');
Route::get('retracker/dev', 'Retracker@dev');
Route::get('retracker/usage', 'Retracker@usage');

Route::get('torrent', 'Torrents@promo');

Route::get('torrents', 'Torrents@index');
Route::post('torrents', 'Torrents@addPost')->middleware('auth');
Route::get('torrents/add', 'Torrents@add')->middleware('auth');
Route::get('torrents/categories', 'Torrents@categories');
Route::get('torrents/categories/{id}', 'Torrents@category');
Route::get('torrents/comments', 'Torrents@comments');
Route::get('torrents/faq', 'Torrents@faq');
Route::get('torrents/{Torrent}', 'Torrents@torrent');
Route::post('torrents/{Torrent}/magnet', 'Torrents@magnet');
