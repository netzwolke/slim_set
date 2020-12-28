<?php

namespace App\Factory;

use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use function DI\factory;


class AppFactory
{


    private $app;

    public function run()
    {
        $this->app->run();
    }
    public function create()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(
            [
                //Twig::class => factory([Twig::class,'create'])->parameter('loader',['path'=>'../src/View'])->parameter('settings',['settings'=> ['cache'=>false]]),
                Twig::class => function()
                {
                    return Twig::create('../src/View',['cache'=>false]);
                },
                TwigMiddleware::class => function(){
                    return TwigMiddleware::create($this,Twig::class);
                }

            ]
        );
        $containerBuilder = $builder->build();
        $this->app = $this->createBridge($containerBuilder);
        $container = $this->app->getContainer();
        $this->createSettings($container);
        $this->createTwig($this->app);
        $this->createRoutes($this->app);
    }

    public function createSettings($container)
    {
        return new Settings($container);
    }

    public function createBridge($containerBuilder)
    {
        return Bridge::create($containerBuilder);
    }
    public function createRoutes($container)
    {
        return new Routes($container);
    }
    public function createTwig($app)
    {
        return new Views($app);
    }
}