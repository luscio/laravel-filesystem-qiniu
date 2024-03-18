<?php

namespace Luscio\LaravelFilesystem\Qiniu;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Overtrue\Flysystem\Qiniu\QiniuAdapter;

class QiniuStorageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Storage::extend('qiniu', function ($app, $config) {
            $adapter = new QiniuAdapter(
                $config['access_key'],
                $config['secret_key'],
                $config['bucket'],
                $config['domain']
            );
            return new FilesystemAdapter(new Filesystem($adapter), $adapter);
        });
    }

    /**
     * Register any application services.
     */
    public function register() {}
}
