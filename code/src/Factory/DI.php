<?php

namespace App\Factory;

use App\Factory\Twig\TwigExtension;
use App\Factory\Twig\TwigRuntimeLoader;
use App\Resources\Redirect;
use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Interfaces\RouteCollectorInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Routing\RouteContext;
use Slim\Routing\RouteParser;
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
                RouteParser::class => factory(function (ContainerInterface $container) {
                    return $container->get(RouteCollector::class)->getRouteParser();
                }),



            ];
    }
}
