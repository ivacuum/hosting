<?php

return [

	'default' => env('CACHE_DRIVER', 'file'),

	'stores' => [

		'apc' => [
			'driver' => 'apc'
		],

		'array' => [
			'driver' => 'array'
		],

		'database' => [
			'driver' => 'database',
			'table'  => 'cache',
			'connection' => null,
		],

		'file' => [
			'driver' => 'file',
			'path'   => storage_path().'/framework/cache',
		],

		'memcached' => [
			'driver'  => 'memcached',
			'servers' => [
				[
					'host' => '/var/run/memcached/memcached.lock', 'port' => 0, 'weight' => 100
				],
			],
		],

		'redis' => [
			'driver' => 'redis',
			'connection' => 'default',
		],

	],

	'prefix' => 'hosting',

];
