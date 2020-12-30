<?php

namespace App\Factory;

use DI\Container;
use Slim\App;


class AppFactory
{


    private $app;

    public function run()
    {
        $this->app->run();
    }
    public function create()
    {
        //Settings
        $container = new Container();
        $this->createSettings($container);

        //App with DI for Typehint
        $this->app = $this->createDI($container);

        //Load Libraries into App
        $this->createViews($this->app);
        $this->createRoutes($this->app);
        $this->createEloquent($container); //TODO: BS Container 
    }

    public function createSettings($container): Settings
    {
        return new Settings($container);
    }

    public function createDI($container): App
    {
        return (new DI())->createBridge($container);
    }
    public function createRoutes($app): Routes
    {
        return new Routes($app);
    }
    public function createViews($app): Views
    {
        return new Views($app);
    }
    public function createEloquent($container): Eloquent
    {
        return new Eloquent($container);
    }
}