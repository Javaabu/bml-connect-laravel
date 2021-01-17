<?php

namespace Javaabu\BmlConnect\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Javaabu\BmlConnect\BmlConnect;

class BmlConnectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(BmlConnect::class, function () {
            $config = $this->app['config']['services.bml_connect'];
            $api_key = Arr::get($config, 'api_key');
            $app_id = Arr::get($config, 'app_id');
            $mode = Arr::get($config, 'mode');
            $client_options = Arr::get($config, 'client_options');

            return new BmlConnect($api_key ?: '', $app_id ?: '', $mode ?: 'production', $client_options ?: []);
        });

        // Register the main class to use with the facade
        $this->app->singleton('bml-connect', function () {
            return $this->app->make(BmlConnect::class);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [BmlConnect::class];
    }
}
