<?php

// Bindings
Route::bind('domain', function($value) {
	return Domain::whereDomain($value)->firstOrFail();
});

// Models
Route::model('client', 'Client');
Route::model('yandex_user', 'YandexUser');
Route::model('user', 'User');

// Routes
Route::get('/', 'HomeController@index');
Route::get('login', 'LoginController@getLogin');
Route::post('login', 'LoginController@postLogin');
Route::get('logout', 'LoginController@getLogout');

Route::get('pages/{url}', function($url) {
	dd(explode('/', $url));
})->where('url', '.*');

Route::get('parser/vk/{page?}/{date?}', 'ParserVk@index')->where('date', '\d{4}-\d{2}-\d{2}');

// Admin control panel
Route::group(['namespace' => 'Acp', 'prefix' => 'acp', 'before' => 'auth'], function() {
	Route::get('/', 'Home@index');
	
	Route::get('clients', 'Clients@index');
	Route::post('clients', 'Clients@store');
	Route::get('clients/create', 'Clients@create');
	Route::get('clients/{client}', 'Clients@show');
	Route::put('clients/{client}', 'Clients@update');
	Route::patch('clients/{client}', 'Clients@update');
	Route::delete('clients/{client}', 'Clients@destroy');
	Route::get('clients/{client}/edit', 'Clients@edit');
	
	Route::get('domains', 'Domains@index');
	Route::post('domains', 'Domains@store');
	Route::get('domains/create', 'Domains@create');
	Route::get('domains/{domain}', 'Domains@show');
	Route::put('domains/{domain}', 'Domains@update');
	Route::patch('domains/{domain}', 'Domains@update');
	Route::delete('domains/{domain}', 'Domains@destroy');
	Route::get('domains/{domain}/edit', 'Domains@edit');
	Route::get('domains/{domain}/mail', 'Domains@mailboxes');
	Route::post('domains/{domain}/mail', 'Domains@addMailbox');
	Route::get('domains/{domain}/ns-records', 'Domains@nsRecords');
	Route::post('domains/{domain}/ns-records', 'Domains@addNsRecord');
	Route::put('domains/{domain}/ns-records', 'Domains@editNsRecord');
	Route::delete('domains/{domain}/ns-records', 'Domains@deleteNsRecord');
	Route::get('domains/{domain}/ns-servers', 'Domains@nsServers');
	Route::post('domains/{domain}/yandex-ns', 'Domains@setYandexNs');
	Route::get('domains/{domain}/whois', 'Domains@whois');
	
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
		Route::get('users/{yandex_user}', 'Users@show');
		Route::put('users/{yandex_user}', 'Users@update');
		Route::patch('users/{yandex_user}', 'Users@update');
		Route::delete('users/{yandex_user}', 'Users@destroy');
		Route::get('users/{yandex_user}/edit', 'Users@edit');
	});
});

Route::get('acp/papertrail', 'SshController@papertrail');
