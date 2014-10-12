<?php

Route::model('clients', 'Client');
Route::bind('domains', function($value) {
	return Domain::whereDomain($value)->first();
});

Route::get('/', 'HomeController@index');

Route::get('domains/whois-update', function() {
	$stream = fopen('php://output', 'w');
	
	Artisan::call('app:parse-vk', [
		'page' => 'palnom6',
		'date' => '2014-10-07'
	], new Symfony\Component\Console\Output\StreamOutput($stream));
	
	return (string) $stream;
});
Route::resource('domains', 'Domains');
Route::get('domains/{domains}/whois', ['as' => 'domains.whois', 'uses' => 'Domains@whois']);

// Route::get('ssh', 'SshController@index');

Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getLogin']);
Route::post('login', 'LoginController@postLogin');
Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);

Route::get('pages/{url}', function($url) {
	print '<pre>';
	print_r(explode('/', $url));
	print '</pre>';
	return;
})->where('url', '.*');

// Route::get('parser/vk', 'ParserVk@index');
// Route::get('parser/vk/{page?}', 'ParserVk@index');
Route::get('parser/vk/{page?}/{date?}', ['as' => 'parser.vk', 'uses' => 'ParserVk@index'])
	->where('date', '\d{4}-\d{2}-\d{2}');

/**
* Admin control panel
*/
Route::when('acp/*', 'auth');

Route::group(['namespace' => 'Acp'], function() {
	Route::get('acp', 'Home@index');
	Route::resource('acp/clients', 'Clients');
});
