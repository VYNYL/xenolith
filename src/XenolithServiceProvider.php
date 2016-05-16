<?php

namespace Vynyl\Xenolith;

use Illuminate\Support\ServiceProvider;
use Vynyl\Xenolith\Command\MakeModelCommand;
use Vynyl\Xenolith\Command\ExampleCommand;

class XenolithServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../config/xenolith.php';

        $this->publishes([
            $configPath => config_path('vynyl/xenolith.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('vynyl.model', function ($app) {
            return new MakeModelCommand();
        });
        $this->app->singleton('vynyl.example', function ($app) {
            return new ExampleCommand();
        });

        $this->commands([
            'vynyl.model',
            'vynyl.example'
        ]);
    }
}

