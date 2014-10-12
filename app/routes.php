<?php

Route::model('clients', 'Client');
Route::bind('domains', function($value) {
	return Domain::whereDomain($value)->first();
});

Route::get('/', 'HomeController@index');

Route::resource('domains', 'Domains');
Route::get('domains/{domains}/whois', ['as' => 'domains.whois', 'uses' => 'Domains@whois']);

// Route::get('ssh', 'SshController@index');

Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getLogin']);
Route::post('login', 'LoginController@postLogin');
Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);

Route::get('pages/{url}', function($url) {
	dd(explode('/', $url));
})->where('url', '.*');

Route::get('parser/vk/{page?}/{date?}', ['as' => 'parser.vk', 'uses' => 'ParserVk@index'])
	->where('date', '\d{4}-\d{2}-\d{2}');

// Admin control panel
Route::when('acp/*', 'auth');

Route::group(['namespace' => 'Acp', 'prefix' => 'acp'], function() {
	Route::get('/', 'Home@index');
	Route::resource('clients', 'Clients');
});
