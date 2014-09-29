<?php

return [
	/* sync, beanstalkd, sqs, iron, redis */
	'default' => 'sync',

	'connections' => [
		'sync' => [
			'driver' => 'sync',
		],

		'redis' => [
			'driver' => 'redis',
			'queue'  => 'default',
		],
	],

	'failed' => [
		'database' => 'mysql',
		'table'    => 'failed_jobs',
	],
];
