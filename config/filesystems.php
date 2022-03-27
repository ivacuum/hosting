<?php

return [
    // local, ftp, sftp, s3
    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => true,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => true,
        ],

        'avatars' => [
            'driver' => 'local',
            'root' => env('AVATARS_ROOT', public_path('uploads/avatars')),
            'url' => env('AVATARS_URL', '/uploads/avatars'),
            'visibility' => 'public',
            'throw' => true,
        ],

        'gallery' => [
            'driver' => 'local',
            'root' => env('GALLERY_ROOT', public_path('uploads/gallery')),
            'url' => env('GALLERY_URL', '/uploads/gallery'),
            'visibility' => 'public',
            'throw' => true,
        ],

        'gallery-raw' => [
            'driver' => 'local',
            'root' => env('GALLERY_ROOT', public_path('uploads/gallery')),
            'url' => env('GALLERY_RAW_URL', '/uploads/gallery'),
            'visibility' => 'public',
            'throw' => true,
        ],

        'files' => [
            'driver' => 'local',
            'root' => env('FILES_ROOT', public_path('uploads/files')),
            'url' => env('FILES_URL', '/uploads/files'),
            'visibility' => 'public',
            'throw' => true,
        ],

        'temp' => [
            'driver' => 'local',
            'root' => public_path('uploads/temp'),
            'url' => '/uploads/temp',
            'visibility' => 'public',
            'throw' => true,
        ],

        'photos' => [
            'driver' => env('PHOTOS_DRIVER', 'sftp'),
            'host' => env('PHOTOS_HOST'),
            'port' => (int) env('PHOTOS_PORT', 22),
            'root' => env('PHOTOS_ROOT', public_path('uploads/photos')),
            'username' => env('PHOTOS_USERNAME'),
            'password' => env('PHOTOS_PASSWORD'),
            'url' => env('PHOTOS_URL', '/uploads/photos'),
            'throw' => true,
            'timeout' => 10,
            'permissions' => [
                'dir' => [
                    'public' => 0755,
                    'private' => 0755,
                ],
                'file' => [
                    'public' => 0644,
                    'private' => 0644,
                ],
            ],
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'aws' => env('AWS_URL'),
            'throw' => true,
        ],
    ],
];
