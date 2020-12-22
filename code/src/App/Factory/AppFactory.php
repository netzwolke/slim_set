<?php

namespace App\Factory;

use DI\Bridge\Slim\Bridge;
use App\Factory\Routes;


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

        $this->createRoutes($this->app);
    }


    public function createBridge()
    {
        return  Bridge::create();
    }
    public function createRoutes($container)
    {
        return new Routes($container);
    }
}