<?php

namespace App\Factory;

use App\Factory\Twig\TwigExtension;
use App\Factory\Twig\TwigRuntimeLoader;
use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Views\Twig;
use function DI\create;
use function DI\factory;

class DI
{

    public function createBridge($container): App
    {
        $builder = new ContainerBuilder();
        $builder->wrapContainer($container);
        $builder->addDefinitions(
            [
                TwigRuntimeLoader::class => create(),
                TwigExtension::class => create(),
                Twig::class => factory(function (ContainerInterface $container, TwigExtension $extension, TwigRuntimeLoader $loader) {
                    $config = $container->get('settings');
                    $path = $config['view']['path'];
                    $settings = $config['view']['settings'];
                    $twig =  Twig::create($path, $settings);
                    $twig->addRuntimeLoader($loader);
                    $twig->addExtension($extension);
                    return $twig;
                }),

            ]
        );
        $containerBuilder = $builder->build();
        return Bridge::create($containerBuilder);
    }
}
