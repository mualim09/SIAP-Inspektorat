<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Carbon\Carbon;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('filesystem', function ($app) {
        return $app->loadComponent('filesystems', 'Illuminate\Filesystem\FilesystemServiceProvider', 'filesystem');
        });

        $this->app->bind('Illuminate\Contracts\Filesystem\Factory', function($app) {
            return new \Illuminate\Filesystem\FilesystemManager($app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //fix mysql database migration
        Schema::defaultStringLength(191);

        // carbon time formatter
        \Carbon\Carbon::setLocale(env('LOCALE', config('app.carbon_locale')));
        setLocale(LC_ALL, config('app.carbon_locale'), config('app.windowstz'));
        //setlocale(LC_ALL,'id_ID','Indonesian','id_Indonesia');
    }
}
