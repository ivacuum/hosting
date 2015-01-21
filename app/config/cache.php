<?php

return [
	/* file, database, apc, memcached, redis, array */
	'driver' => 'memcached',
	'path' => storage_path() . '/cache',
	'connection' => null,
	'table' => 'cache',
	'memcached' => [
		['host' => '/var/run/memcached/memcached.lock', 'port' => 0, 'weight' => 1],
	],
	'prefix' => 'hosting',
];
