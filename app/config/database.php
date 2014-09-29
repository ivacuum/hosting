<?php

return [
	'fetch' => PDO::FETCH_CLASS,

	'default' => 'mysql',

	'connections' => [
		'mysql' => [
			'driver'    => 'mysql',
			'host'      => getenv('MYSQL_HOST'),
			'database'  => getenv('MYSQL_DB'),
			'username'  => getenv('MYSQL_USER'),
			'password'  => getenv('MYSQL_PASS'),
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
			'options'   => [
				PDO::MYSQL_ATTR_SSL_CERT => '/usr/local/etc/mysql/ssl/client-cert.pem',
				PDO::MYSQL_ATTR_SSL_KEY  => '/usr/local/etc/mysql/ssl/client-key.pem',
			],
		],
	],

	'migrations' => 'migrations',

	'redis' => [
		'cluster' => false,

		'default' => [
			'host'     => '127.0.0.1',
			'port'     => 6379,
			'database' => 0,
		],
	],
];
