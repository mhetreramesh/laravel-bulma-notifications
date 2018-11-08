<?php

namespace Onicial\LaravelBulmaNotifications;

use Illuminate\Support\ServiceProvider;

class BulmaNotificationsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerHelpers();
        $this->loadViewsFrom(__DIR__ . '/views', 'bulma');
        $this->publishes(
            [
                __DIR__ . '/views' => resource_path('views/vendor/bulma-notifications'),
            ]
        );

        $this->publishes([
            __DIR__.'/js' => public_path('vendor/bulma-notifications'),
        ], 'public');
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Onicial\LaravelBulmaNotifications\ToNotifications'
        );
        $this->app->singleton('notify', function ($app) {
            return $this->app->make('Onicial\LaravelBulmaNotifications\Notify');
        });
    }
    /**
     * Register helpers file
     */
    public function registerHelpers()
    {
        if (file_exists($file = __DIR__ . '/functions.php')) {
            require $file;
        }
    }
}