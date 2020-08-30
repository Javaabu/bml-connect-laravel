<?php

namespace Javaabu\BmlConnectLaravel;

use BMLConnect\Client;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class BmlConnectLaravelServiceProvider extends ServiceProvider implements DeferrableProvider
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
        $this->app->singleton(Client::class, function () {
            $config = $this->app['config']['services.bml_connect'];
            $api_key = Arr::get($config, 'api_key');
            $app_id = Arr::get($config, 'app_id');
            $mode = Arr::get($config, 'mode');
            $client_options = Arr::get($config, 'client_options');

            return new Client($api_key, $app_id, $mode ?: 'production', $client_options ?: []);
        });

        // Register the main class to use with the facade
        $this->app->singleton('bml-connect', function () {
            return $this->app->make(Client::class);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Client::class];
    }
}
