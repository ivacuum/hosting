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

        'public' => [
            'driver'     => 'local',
            'root'       => storage_path('app/public'),
            'visibility' => 'public',
        ],

        'gallery' => [
            'driver'     => 'local',
            'root'       => env('GALLERY_ROOT', public_path('uploads/gallery')),
            'visibility' => 'public',
        ],

        'ftp' => [
            'driver'   => 'ftp',
            'host'     => env('FTP_HOST'),
            'port'     => 21,
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),
            'root'     => env('FTP_ROOT'),
            'passive'  => true,
            'ssl'      => false,
            'timeout'  => 10,
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
