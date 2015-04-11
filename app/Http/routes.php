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
	
	Route::group(['prefix' => 'servers'], function() {
		Route::get('/', 'Servers@index');
		Route::post('/', 'Servers@store');
		Route::get('create', 'Servers@create');
		Route::get('{Server}', 'Servers@show');
		Route::put('{Server}', 'Servers@update');
		Route::patch('{Server}', 'Servers@update');
		Route::delete('{Server}', 'Servers@destroy');
		Route::get('{Server}/edit', 'Servers@edit');
		
		Route::group(['namespace' => 'Servers', 'prefix' => '{Server}/ftp'], function() {
			Route::get('/', 'Ftp@index');
			Route::post('file', 'Ftp@filePost');
			Route::post('dir', 'Ftp@dirPost');
			Route::get('source', 'Ftp@source');
			Route::post('source', 'Ftp@sourcePost');
			Route::post('upload', 'Ftp@uploadPost');
		});
	});
	
	Route::get('users', 'Users@index');
	Route::post('users', 'Users@store');
	Route::get('users/create', 'Users@create');
	Route::get('users/{User}', 'Users@show');
	Route::put('users/{User}', 'Users@update');
	Route::patch('users/{User}', 'Users@update');
	Route::delete('users/{User}', 'Users@destroy');
	Route::get('users/{User}/edit', 'Users@edit');
	
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
