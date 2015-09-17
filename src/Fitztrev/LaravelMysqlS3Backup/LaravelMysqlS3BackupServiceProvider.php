<?php

namespace Fitztrev\LaravelMysqlS3Backup;

use Illuminate\Support\ServiceProvider;

class LaravelMysqlS3BackupServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../../config/config.php' => config_path('laravel-mysql-s3-backup.php')]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'laravel-mysql-s3-backup');

        $this->app['fitztrev/laravel-mysql-s3-backup'] = $this->app->share(function(){
            return new Commands\MysqlS3Backup();
        });
        $this->commands([
            'fitztrev/laravel-mysql-s3-backup'
        ]);
    }
}
