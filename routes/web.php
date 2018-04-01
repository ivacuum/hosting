<?php

Route::get('/', 'Home@index');

Route::get('auth/login', 'Auth\SignIn@index')->middleware('guest');
Route::post('auth/login', 'Auth\SignIn@login')->middleware('guest');
Route::get('auth/logout', 'Auth\SignIn@logout')->middleware('auth');

Route::get('auth/register', 'Auth\NewAccount@index')->middleware('guest');
Route::post('auth/register', 'Auth\NewAccount@register')->middleware('guest');
Route::get('auth/register/confirm/{token}', 'Auth\NewAccount@confirm')->middleware('guest');

Route::get('auth/password/remind', 'Auth\ForgotPassword@index')->middleware('guest');
Route::post('auth/password/remind', 'Auth\ForgotPassword@sendResetLink');

Route::get('auth/password/reset/{token}', 'Auth\ResetPassword@index');
Route::post('auth/password/reset', 'Auth\ResetPassword@reset');

// OAuth
Route::get('auth/facebook', 'Auth\Facebook@index');
Route::get('auth/facebook/callback', 'Auth\Facebook@callback');
Route::get('auth/google', 'Auth\Google@index');
Route::get('auth/google/callback', 'Auth\Google@callback');
Route::get('auth/vk', 'Auth\Vk@index');
Route::get('auth/vk/callback', 'Auth\Vk@callback');

Route::get('ajax/chat', 'AjaxChat@index')->middleware('auth');
Route::post('ajax/chat', 'AjaxChat@store')->middleware('auth');
Route::post('ajax/comment/{type}/{id}', 'AjaxComment@store');

Route::get('about', 'Home@about');

Route::get('comments/{id}/confirm', 'CommentConfirm@update')->middleware('auth');

Route::get('dc', 'Dcpp@index');
Route::get('dc/hubs', 'DcppHubs@index');
Route::post('dc/hubs/{id}/click', 'DcppHubClick@store');
Route::get('dc/{slug}', 'Dcpp@page');

Route::get('docs', 'Docs@index');
Route::get('docs/{slug}', 'Docs@page');

Route::get('files', 'Files@index');
Route::get('files/{id}/dl', 'Files@download');

Route::get('gallery', 'Gallery@index')->middleware('auth');
Route::get('gallery/preview/{image}', 'Gallery@preview');
Route::get('gallery/view/{image}', 'Gallery@view');
Route::get('gallery/upload', 'Gallery@upload')->middleware('auth');
Route::post('gallery/upload', 'Gallery@store')->middleware('auth');

Route::get('life', 'Life@index');
Route::get('life/calendar', 'Life@calendar');
Route::get('life/cities', 'Life@cities');
Route::get('life/countries', 'Life@countries');
Route::get('life/countries/{slug}', 'Life@country');
Route::get('life/gigs', 'Life@gigs');
Route::get('life/gigs/rss', 'LifeGigsRss@index');
Route::get('life/rss', 'LifeTripsRss@index');
Route::get('life/{slug}', 'Life@page');

Route::get('japanese', 'Japanese@index');
Route::get('japanese/hiragana-katakana', 'JapaneseHiraganaKatakana@index');
Route::get('japanese/wanikani', 'JapaneseWanikani@index');
Route::get('japanese/wanikani/kanji', 'JapaneseWanikaniKanji@index');
Route::get('japanese/wanikani/kanji/{character}', 'JapaneseWanikaniKanji@show');
Route::put('japanese/wanikani/kanji/{id}', 'JapaneseWanikaniKanji@update')->middleware('auth');
Route::delete('japanese/wanikani/kanji/{id}', 'JapaneseWanikaniKanji@destroy')->middleware('auth');
Route::get('japanese/wanikani/level', 'JapaneseWanikaniLevel@index');
Route::get('japanese/wanikani/level/{level}', 'JapaneseWanikaniLevel@show');
Route::get('japanese/wanikani/radicals', 'JapaneseWanikaniRadicals@index');
Route::get('japanese/wanikani/radicals/{meaning}', 'JapaneseWanikaniRadicals@show');
Route::put('japanese/wanikani/radicals/{id}', 'JapaneseWanikaniRadicals@update')->middleware('auth');
Route::delete('japanese/wanikani/radicals/{id}', 'JapaneseWanikaniRadicals@destroy')->middleware('auth');
Route::post('japanese/wanikani/search', 'JapaneseWanikaniSearch@index');
Route::get('japanese/wanikani/vocabulary', 'JapaneseWanikaniVocabulary@index');
Route::get('japanese/wanikani/vocabulary/{characters}', 'JapaneseWanikaniVocabulary@show');
Route::put('japanese/wanikani/vocabulary/{id}', 'JapaneseWanikaniVocabulary@update')->middleware('auth');
Route::delete('japanese/wanikani/vocabulary/{id}', 'JapaneseWanikaniVocabulary@destroy')->middleware('auth');

Route::get('mail/click/{timestamp}/{id}', 'Mail@click')->name('mail.click');
Route::get('mail/report/{timestamp}/{id}', 'Mail@report')->middleware('auth');
Route::get('mail/view/{timestamp}/{id}', 'Mail@view');

Route::get('subscriptions', 'Subscriptions@edit');
Route::post('subscriptions', 'Subscriptions@store');
Route::put('subscriptions', 'Subscriptions@update')->middleware('auth');
Route::get('subscriptions/confirm', 'Subscriptions@confirm')->middleware('auth');

Route::get('my', 'My@index')->middleware('auth');
Route::put('my/avatar', 'MyAvatar@update')->middleware('auth');
Route::get('my/password', 'MyPassword@edit')->middleware('auth');
Route::put('my/password', 'MyPassword@update')->middleware('auth');
Route::get('my/profile', 'MyProfile@edit')->middleware('auth');
Route::put('my/profile', 'MyProfile@update')->middleware('auth');
Route::get('my/settings', 'MySettings@edit')->middleware('auth');
Route::put('my/settings', 'MySettings@update')->middleware('auth');

Route::get('my/trips', 'MyTrips@index')->middleware('auth');
Route::post('my/trips', 'MyTrips@store')->middleware('auth');
Route::get('my/trips/create', 'MyTrips@create')->middleware('auth');
Route::get('my/trips/{id}', 'MyTrips@show')->middleware('auth');
Route::put('my/trips/{id}', 'MyTrips@update')->middleware('auth');
Route::delete('my/trips/{id}', 'MyTrips@destroy')->middleware('auth');
Route::get('my/trips/{id}/edit', 'MyTrips@edit')->middleware('auth');

Route::get('news', 'News@index');
Route::get('news/rss', 'NewsRss@index');
Route::get('news/{id}', 'News@show');
Route::get('news/{year}/{month}', 'News@bc');
Route::get('news/{year}/{month}/{day}', 'News@bc');
Route::get('news/{year}/{month}/{day}/{slug}', 'News@bc');

Route::get('notifications', 'Notifications@index')->middleware('auth');

Route::get('parser/vk/{page?}/{date?}', 'ParserVk@index')->where('date', '\d{4}-\d{2}-\d{2}');
Route::post('parser/vk', 'ParserVk@indexPost');

Route::get('photos', 'Photos@index');
Route::get('photos/cities', 'Photos@cities');
Route::get('photos/cities/{slug}', 'Photos@city');
Route::get('photos/countries', 'Photos@countries');
Route::get('photos/countries/{slug}', 'Photos@country');
Route::get('photos/faq', 'Photos@faq');
Route::get('photos/map', 'Photos@map');
Route::get('photos/tags', 'Photos@tags');
Route::get('photos/tags/{id}', 'Photos@tag');
Route::get('photos/trips', 'Photos@trips');
Route::get('photos/trips/{id}', 'Photos@trip');
Route::get('photos/{id}', 'Photos@show');

Route::get('promocodes-coupons', 'Coupons@index');
Route::get('promocodes-coupons/airbnb', 'Coupons@airbnb');
Route::get('promocodes-coupons/booking', 'Coupons@booking');
Route::get('promocodes-coupons/digitalocean', 'Coupons@digitalocean');
Route::get('promocodes-coupons/firstvds', 'Coupons@firstvds');
Route::post('promocodes-coupons/firstvds', 'Coupons@firstvdsPost');
Route::get('promocodes-coupons/timeweb', 'Coupons@timeweb');

Route::get('retracker', 'Retracker@index');
Route::get('retracker/dev', 'Retracker@dev');
Route::get('retracker/usage', 'Retracker@usage');

Route::get('stickers', 'Stickers@index');

Route::get('torrent', 'TorrentPromo@index');

Route::get('torrents', 'Torrents@index');
Route::post('torrents', 'Torrents@store')->middleware('auth');
Route::get('torrents/add', 'Torrents@create')->middleware('auth');
Route::get('torrents/comments', 'Torrents@comments');
Route::get('torrents/faq', 'Torrents@faq');
Route::get('torrents/my', 'Torrents@my')->middleware('auth');
Route::get('torrents/{torrent}', 'Torrents@show');
Route::post('torrents/{torrent}/magnet', 'Torrents@magnet');

Route::get('trips/{trip}', 'Trips@show');

Route::get('users', 'Users@index');
Route::get('users/{id}', 'Users@show');

Route::get('@{login}', 'UserHome@index');
Route::get('@{login}/travel', 'UserTravelTrips@index');
Route::get('@{login}/travel/cities', 'UserTravelCities@index');
Route::get('@{login}/travel/cities/{slug}', 'UserTravelCities@show');
Route::get('@{login}/travel/countries', 'UserTravelCountries@index');
Route::get('@{login}/travel/countries/{slug}', 'UserTravelCountries@show');
Route::get('@{login}/travel/{slug}', 'UserTravelTrips@show');
