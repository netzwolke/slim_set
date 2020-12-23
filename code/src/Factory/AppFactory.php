<?php

namespace App\Factory;

use DI\Bridge\Slim\Bridge;


class AppFactory
{


    private $app;

    public function run()
    {
        $this->app->run();
    }
    public function create()
    {
        $this->app = $this->createBridge();
        $container = $this->app->getContainer();
        $this->createSettings($container);
        $this->createRoutes($this->app);
        $this->createTwig($container);
    }

    public function createSettings($container)
    {
        return new Settings($container);
    }

    public function createBridge()
    {
        return Bridge::create();
    }
    public function createRoutes($container)
    {
        return new Routes($container);
    }
    public function createTwig($container)
    {
        return new Views($container);
    }
}