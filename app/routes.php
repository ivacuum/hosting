<?php

// Models
Route::model('clients', 'Client');
Route::model('users', 'User');

Route::bind('domains', function($value) {
	return Domain::whereDomain($value)->first();
});

// Routes
Route::get('/', [
	'as'   => 'home',
	'uses' => 'HomeController@index'
]);

// Route::get('ssh', 'SshController@index');

Route::get('login', [
	'as'   => 'login',
	'uses' => 'LoginController@getLogin'
]);
Route::post('login', 'LoginController@postLogin');
Route::get('logout', [
	'as'   => 'logout',
	'uses' => 'LoginController@getLogout'
]);

Route::get('pages/{url}', function($url) {
	dd(explode('/', $url));
})->where('url', '.*');

Route::get('parser/vk/{page?}/{date?}', [
	'as'   => 'parser.vk',
	'uses' => 'ParserVk@index'
])->where('date', '\d{4}-\d{2}-\d{2}');

// Admin control panel
Route::group(['namespace' => 'Acp', 'prefix' => 'acp', 'before' => 'auth'], function() {
	Route::get('/', [
		'as'   => 'acp.home',
		'uses' => 'Home@index',
	]);
	
	Route::resource('clients', 'Clients');
	
	Route::resource('domains', 'Domains');
	Route::post('domains/{domains}/set-yandex-ns', [
		'as'   => 'acp.domains.set-yandex-ns',
		'uses' => 'Domains@setYandexNs'
	]);
	Route::get('domains/{domains}/whois', [
		'as'   => 'acp.domains.whois',
		'uses' => 'Domains@whois'
	]);
	
	Route::resource('users', 'Users');
});
