<?php

return [

    // local, ftp, sftp, s3
    'default' => env('FILESYSTEM_DRIVER', 'local'),

    // for both local filesystem and remote cloud
    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        'avatars' => [
            'driver' => 'local',
            'root' => env('AVATARS_ROOT', public_path('uploads/avatars')),
            'url' => env('AVATARS_URL', '/uploads/avatars'),
            'visibility' => 'public',
        ],

        'gallery' => [
            'driver' => 'local',
            'root' => env('GALLERY_ROOT', public_path('uploads/gallery')),
            'url' => env('GALLERY_URL', '/uploads/gallery'),
            'visibility' => 'public',
        ],

        'files' => [
            'driver' => 'local',
            'root' => env('FILES_ROOT', public_path('uploads/files')),
            'url' => env('FILES_URL', '/uploads/files'),
            'visibility' => 'public',
        ],

        'temp' => [
            'driver' => 'local',
            'root' => public_path('uploads/temp'),
            'url' => '/uploads/temp',
            'visibility' => 'public',
        ],

        'photos' => [
            'driver' => 'sftp',
            'host' => env('PHOTOS_HOST'),
            'port' => env('PHOTOS_PORT'),
            'root' => env('PHOTOS_ROOT'),
            'username' => env('PHOTOS_USERNAME'),
            'password' => env('PHOTOS_PASSWORD'),
            'url' => env('PHOTOS_URL', '/uploads/photos'),
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'aws' => env('AWS_URL'),
        ],

    ],

];
