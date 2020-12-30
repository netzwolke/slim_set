<?php

namespace App\Factory;

use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Views\Twig;
use function DI\factory;

class DI
{

    public function createBridge($container): App
    {
        $builder = new ContainerBuilder();
        $builder->wrapContainer($container);
        $builder->addDefinitions(
            [

                Twig::class => factory( function (ContainerInterface $container) {
                    $config = $container->get('settings');
                    $path = $config['view']['path'];
                    $settings = $config['view']['settings'];
                    return Twig::create($path,$settings);
                }),

            ]
        );
        $containerBuilder = $builder->build();
        return Bridge::create($containerBuilder);
    }
}