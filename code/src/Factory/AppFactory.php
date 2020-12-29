<?php

namespace App\Factory;

use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Views\Twig;
use function DI\factory;
use function DI\get;


class AppFactory
{


    private $app;

    public function run()
    {
        $this->app->run();
    }
    public function create()
    {
        $settings = new Container();
        $this->createSettings($settings);
        $builder = new ContainerBuilder();
        $builder->wrapContainer($settings);
        $builder->addDefinitions(
            [
                //Twig::class => factory([Twig::class,'create'])->parameter('path','../src/View')->parameter('settings',['cache'=>false]),
                Twig::class => factory( function (ContainerInterface $container) {
                    $config = $container->get('settings');
                    $path = $config['view']['path'];
                    $settings = $config['view']['settings'];
                    return Twig::create($path,$settings);
                }),

            ]
        );
        $containerBuilder = $builder->build();
        $this->app = $this->createBridge($containerBuilder);
        $this->createViews($this->app);
        $this->createRoutes($this->app);
        $this->createEloquent($settings);
    }

    public function createSettings($container): Settings
    {
        return new Settings($container);
    }

    public function createBridge($containerBuilder): App
    {
        return Bridge::create($containerBuilder);
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