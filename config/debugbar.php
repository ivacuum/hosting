<?php

return [

	'enabled' => null,

	'storage' => [
		'enabled'    => true,
		'driver'     => 'file', // redis, file, pdo
		'path'       => storage_path() . '/debugbar', // For file driver
		'connection' => null,   // Leave null for default connection (Redis/PDO)
	],

	'include_vendors' => false,

	'capture_ajax' => true,

	'collectors' => [
		'phpinfo'         => false,  // Php version
		'messages'        => false,  // Messages
		'time'            => false,  // Time Datalogger
		'memory'          => false,  // Memory usage
		'exceptions'      => false,  // Exception displayer
		'log'             => false,  // Logs from Monolog (merged in messages if enabled)
		'db'              => true,  // Show database (PDO) queries and bindings
		'views'           => false,  // Views with their data
		'route'           => true,  // Current route information
		'laravel'         => false, // Laravel version and environment
		'events'          => false, // All events fired
		'default_request' => false, // Regular or special Symfony request logger
		'symfony_request' => true,  // Only one can be enabled..
		'mail'            => false,  // Catch mail messages
		'logs'            => false, // Add the latest log messages
		'files'           => false, // Show the included files
		'config'          => false, // Display config settings
		'auth'            => false, // Display Laravel authentication status
		'session'         => false,  // Display session data
	],

	'options' => [

		'auth' => ['show_name' => false],   // Also show the users name/email in the debugbar
		'db'   => [
			'with_params' => true,   // Render SQL with the parameters substituted
			'timeline'    => false,  // Add the queries to the timeline
			'backtrace'   => true,  // EXPERIMENTAL: Use a backtrace to find the origin of the query in your files.
			'explain'     => [            // EXPERIMENTAL: Show EXPLAIN output on queries
				'enabled'    => false,
				'types'      => ['SELECT'],
			],
			'hints'       => false,    // Show hints for common mistakes
		],
		'mail'  => ['full_log' => false],
		'views' => ['data' => false],    //Note: Can slow down the application, because the data can be quite large..
		'route' => ['label' => true],  // show complete route on bar
		'logs'  => ['file' => null],

	],

	'inject' => true,

	'route_prefix' => '_debugbar',

];
