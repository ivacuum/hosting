<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;

class SftpServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Storage::extend('sftp', function ($app, $config) {
            $adapter = new SftpAdapter(array_merge([
                'timeout' => 10,
                'directoryPerm' => 0755,
            ], $config));

            return new Filesystem($adapter);
        });
    }

    public function register()
    {
    }
}
