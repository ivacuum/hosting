<?php

Route::get('/', function() {
	return View::make('hello');
});

Route::get('domains', ['as' => 'domains.index', 'uses' => 'Domains@index']);
Route::get('domains/{id}', ['as' => 'domains.show', 'uses' => 'Domains@show']);

Route::get('ssh', 'SshController@index');

Route::get('users', function() {
	return View::make('users');
});

Route::get('pages/{url}', function($url) {
	print '<pre>';
	print_r(explode('/', $url));
	print '</pre>';
	return;
})->where('url', '(.*)');
