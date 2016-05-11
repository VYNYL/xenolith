<?php

namespace Vynyl\Xenolith\ServiceProvider;

use Illuminate\Support\ServiceProvider;

class VynylXenolithServiceProvider extends ServiceProvider
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
        // services will go here
    }
}

