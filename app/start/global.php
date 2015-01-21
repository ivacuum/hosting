<?php

ClassLoader::addDirectories([
	app_path() . '/commands',
	app_path() . '/controllers',
	app_path() . '/models',
	app_path() . '/database/seeds',
]);

Log::useFiles(storage_path() . '/logs/laravel.log');

App::error(function(Exception $exception, $code) {
	Log::error($exception);
});

App::down(function() {
	return Response::make('Be right back!', 503);
});

App::missing(function(Exception $e) {
	return Response::make('404 Not Found', 404);
});

setlocale(LC_ALL, 'ru_RU.UTF-8');

View::addExtension('html', 'blade');

require app_path() . '/events.php';
require app_path() . '/filters.php';
require app_path() . '/helpers.php';
