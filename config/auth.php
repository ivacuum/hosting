<?php

return [

	// database, eloquent
	'driver' => 'eloquent',
	'model' => 'App\User',
	'table' => 'users',
	'password' => [
		'email' => 'emails.auth.password.remind',
		'table' => 'password_reminders',
		'expire' => 60, // min
	],

];
