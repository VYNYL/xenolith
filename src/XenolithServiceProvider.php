<?php

namespace Vynyl\Xenolith;

use Illuminate\Support\ServiceProvider;
use \Twig_Loader_Filesystem;
use \Twig_Environment;
use Vynyl\Xenolith\Command\MakeModelCommand;
use Vynyl\Xenolith\Command\ExampleCommand;
use Vynyl\Xenolith\Marshaller\ExampleMarshaller;
use Vynyl\Xenolith\Marshaller\ModelMarshaller;

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
        // Twig
        // So as to avoid potential conflicts with other instances of Twig
        $this->app->singleton('vynyl.twig', function ($app) {
            $loader = new Twig_Loader_Filesystem(__DIR__ .'/../templates');
            return new Twig_Environment($loader, array(
                'cache' => storage_path('/vynyl.twig/cache'),
            ));
        });

        // Marshallers
        $this->app->singleton('vynyl.marshaller.model', function ($app) {
            return new ModelMarshaller($app['files'], $app['vynyl.twig']);
        });
        $this->app->singleton('vynyl.marshaller.example', function ($app) {
            return new ExampleMarshaller($app['files'], $app['vynyl.twig']);
        });

        // Commands
        $this->app->singleton('vynyl.model', function ($app) {
            return new MakeModelCommand($app['vynyl.marshaller.model']);
        });
        $this->app->singleton('vynyl.example', function ($app) {
            return new ExampleCommand($app['vynyl.marshaller.example']);
        });

        $this->commands([
            'vynyl.model',
            'vynyl.example'
        ]);
    }
}

