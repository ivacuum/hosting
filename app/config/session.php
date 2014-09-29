<?php

return [
	/* file, cookie, database, apc, memcached, redis, array */
	'driver'          => 'file',
	'lifetime'        => 30,
	'expire_on_close' => false,
	'files'           => storage_path() . '/sessions',
	'connection'      => null,
	'table'           => 'sessions',
	'lottery'         => [2, 100],
	'cookie'          => 'laravel_session',
	'path'            => '/',
	'domain'          => null,
	'secure'          => false,
];
