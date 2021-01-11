<?php

namespace App\Factory;

use App\Factory\Twig\TwigExtension;
use App\Factory\Twig\TwigRuntimeLoader;
use App\Resources\Logger;
use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Views\Twig;
use function DI\create;
use function DI\factory;

class DI
{
    /**
     * @var Container
     */
    private $containerBuilder;

    public function __construct(ContainerInterface $container)
    {
        $this->createBridge($container);
    }

    public function getApp(): App
    {
        return Bridge::create($this->containerBuilder);
    }

    public function createBridge(ContainerInterface $container)
    {
        $builder = new ContainerBuilder();
        $builder->wrapContainer($container);
        $builder->addDefinitions($this->setDefinitions());
        $this->containerBuilder = $builder->build();
    }

    public function setDefinitions(): array
    {
        return
            [
                Logger::class => factory( function()
                {
                    return Logger::create();
                }),

                TwigRuntimeLoader::class => create()->constructor(Logger::class),
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



            ];
    }
}
