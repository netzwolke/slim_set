<?php


namespace App\Factory;



use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use function DI\factory;

class Views
{
    public function __construct(App $app)
    {
        $container = $app->getContainer();
        $container->set('view', $this->createTwig($container));
        $app->add(TwigMiddleware::createFromContainer($app));
    }
    public function createTwig($container)
    {
        $settings = $container->get('settings')['view'];
        return Twig::create($settings['path'],$settings['settings']);
    }
}