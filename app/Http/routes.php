<?php

Route::get('/', 'Home@index');
Route::get('auth/login', 'Auth@login');
Route::post('auth/login', 'Auth@loginPost');
Route::get('auth/logout', 'Auth@logout');
Route::get('auth/register', 'Auth@register');
Route::post('auth/register', 'Auth@registerPost');
Route::get('auth/password/remind', 'Auth@passwordRemind');
Route::post('auth/password/remind', 'Auth@passwordRemindPost');
Route::get('auth/password/reset/{token}', 'Auth@passwordReset');
Route::post('auth/password/reset', 'Auth@passwordResetPost');

Route::get('cv', 'Home@cv');
Route::get('life/{page}', 'Home@life');

Route::get('parser/vk/{page?}/{date?}', 'ParserVk@index')
	->where('date', '\d{4}-\d{2}-\d{2}');

// Admin control panel
Route::group(['namespace' => 'Acp', 'prefix' => 'acp', 'middleware' => ['auth', 'admin']], function() {
	Route::get('/', 'Home@index');
	
	Route::get('clients', 'Clients@index');
	Route::post('clients', 'Clients@store');
	Route::get('clients/create', 'Clients@create');
	Route::get('clients/{Client}', 'Clients@show');
	Route::put('clients/{Client}', 'Clients@update');
	Route::patch('clients/{Client}', 'Clients@update');
	Route::delete('clients/{Client}', 'Clients@destroy');
	Route::get('clients/{Client}/edit', 'Clients@edit');
	
	Route::get('domains', 'Domains@index');
	Route::post('domains', 'Domains@store');
	Route::get('domains/create', 'Domains@create');
	Route::get('domains/{Domain}', 'Domains@show');
	Route::put('domains/{Domain}', 'Domains@update');
	Route::patch('domains/{Domain}', 'Domains@update');
	Route::delete('domains/{Domain}', 'Domains@destroy');
	Route::get('domains/{Domain}/edit', 'Domains@edit');
	Route::get('domains/{Domain}/mail', 'Domains@mailboxes');
	Route::post('domains/{Domain}/mail', 'Domains@addMailbox');
	Route::get('domains/{Domain}/ns-records', 'Domains@nsRecords');
	Route::post('domains/{Domain}/ns-records', 'Domains@addNsRecord');
	Route::put('domains/{Domain}/ns-records', 'Domains@editNsRecord');
	Route::delete('domains/{Domain}/ns-records', 'Domains@deleteNsRecord');
	Route::get('domains/{Domain}/ns-servers', 'Domains@nsServers');
	Route::get('domains/{Domain}/robots', 'Domains@robots');
	Route::post('domains/{Domain}/server-ns', 'Domains@setServerNsRecords');
	Route::get('domains/{Domain}/yandex-pdd-status', 'Domains@yandexPddStatus');
	Route::post('domains/{Domain}/yandex-ns', 'Domains@setYandexNs');
	Route::get('domains/{Domain}/whois', 'Domains@whois');
	
	Route::get('pages', 'Pages@index');
	Route::post('pages', 'Pages@store');
	Route::post('pages/batch', 'Pages@batch');
	Route::get('pages/create', 'Pages@create');
	Route::post('pages/move', 'Pages@move');
	Route::get('pages/tree', 'Pages@tree');
	Route::get('pages/{Page}', 'Pages@show');
	Route::put('pages/{Page}', 'Pages@update');
	Route::patch('pages/{Page}', 'Pages@update');
	Route::delete('pages/{Page}', 'Pages@destroy');
	Route::get('pages/{Page}/edit', 'Pages@edit');
	
	Route::get('users', 'Users@index');
	Route::post('users', 'Users@store');
	Route::get('users/create', 'Users@create');
	Route::get('users/{user}', 'Users@show');
	Route::put('users/{user}', 'Users@update');
	Route::patch('users/{user}', 'Users@update');
	Route::delete('users/{user}', 'Users@destroy');
	Route::get('users/{user}/edit', 'Users@edit');
	
	Route::group(['namespace' => 'Yandex', 'prefix' => 'yandex'], function() {
		Route::get('users', 'Users@index');
		Route::post('users', 'Users@store');
		Route::get('users/create', 'Users@create');
		Route::get('users/{YandexUser}', 'Users@show');
		Route::put('users/{YandexUser}', 'Users@update');
		Route::patch('users/{YandexUser}', 'Users@update');
		Route::delete('users/{YandexUser}', 'Users@destroy');
		Route::get('users/{YandexUser}/edit', 'Users@edit');
	});
});
