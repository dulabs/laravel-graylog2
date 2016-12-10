<?php namespace Dulabs\Graylog2;



use Monolog\Logger;

use Illuminate\Log\Writer;

use Illuminate\Support\ServiceProvider;



class Graylog2ServiceProvider extends ServiceProvider

{

    public function register()

    {

        $this->app->bind('graylog2', function ($app) {

            return new Graylog2();

        });

    }



    public function boot()

    {

        $this->publishes([

            __DIR__ . '/config/graylog2.php' => config_path('graylog2.php'),

        ]);



        $logger = $this->app['log'];





        // Make sure the logger is a Writer instance

        if ($logger instanceof Writer) {

            $monolog = $logger->getMonolog();



            // Make sure the Monolog Logger is returned

            if ($monolog instanceof Logger) {

                // Create your custom handler

                $handler = new Graylog2Handler();

                // Push it to monolog

                $monolog->pushHandler($handler);

            }

        }

    }



    public function provides()

    {

        return [

            'graylog2',

        ];

    }

}