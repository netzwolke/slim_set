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
    }//end run()


    public function create()
    {
        // Settings!
        $container = new Container();
        $this->createSettings($container);

        // App with DI for Typehint!
        $DI = $this->createDI($container);
        $this->app = $DI->getApp();

        // Load Libraries into App!
        $this->createRoutes($this->app);
        $this->createModel($container);

        $this->createMiddleware($this->app);
    }//end create()

    public function createSettings($container): Settings
    {
        return new Settings($container);
    }//end createSettings()

    public function createDI($container): DI
    {
        return new DI($container);
    }//end createDI()

    public function createRoutes($app): Routes
    {
        return new Routes($app);
    }//end createRoutes()

    public function createModel($container): Model
    {
        return new Model($container);
    }//end createEloquent()

    public function createMiddleware(App $app)
    {
        return new Middleware($app);
    }
}//end class
