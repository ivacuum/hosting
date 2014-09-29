<?php

return [
	'driver' => 'eloquent',
	'model'  => 'User',
	'table'  => 'users',

	'reminder' => [
		'email'  => 'emails.auth.reminder',
		'table'  => 'password_reminders',
		'expire' => 60, // min
	],
];
