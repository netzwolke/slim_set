<?php


namespace App\Factory;



use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

class Views
{
    public function __construct(App $app)
    {
        $app->add($this->createTwig($app));
    }
    public function createTwig($app): TwigMiddleware
    {
        return TwigMiddleware::createFromContainer($app,Twig::class);
    }
}