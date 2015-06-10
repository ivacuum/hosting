<?php

return [
	
	// local, ftp, s3, rackspace
	'default' => 'local',

	// for both local filesystem and remote cloud
	'cloud' => 's3',

	'disks' => [

		'local' => [
			'driver' => 'local',
			'root'   => storage_path('app'),
		],

        'ftp' => [
            'driver'   => 'ftp',
            'host'     => 'ftp.example.com',
            'username' => 'your-username',
            'password' => 'your-password',
			
            // Optional FTP Settings...
            // 'port'     => 21,
            // 'root'     => '',
            // 'passive'  => true,
            // 'ssl'      => true,
            // 'timeout'  => 30,
        ],
		
		's3' => [
			'driver' => 's3',
			'key'    => env('S3_KEY'),
			'secret' => env('S3_SECRET'),
			'region' => env('S3_REGION'),
			'bucket' => env('S3_BUCKET'),
		],

		'rackspace' => [
			'driver'    => 'rackspace',
			'username'  => 'your-username',
			'key'       => 'your-key',
			'container' => 'your-container',
			'endpoint'  => 'https://identity.api.rackspacecloud.com/v2.0/',
			'region'    => 'IAD',
			'url_type'  => 'publicURL',
		],

	],

];
