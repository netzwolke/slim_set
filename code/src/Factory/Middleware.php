<?php


namespace App\Factory;


use App\Middleware\SeederMiddleware;
use App\Middleware\SessionMiddleware;
use Slim\App;
use Slim\Middleware\MethodOverrideMiddleware;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

class Middleware
{
    public function __construct(App $app)
    {
        $this->addMiddleware($app);
    }
    public function addMiddleware(App $app)
    {

        //Add SeederMiddleware before routing

        //Add TwigMiddleware
        $app->add($this->createTwigMiddleware($app));

        //Add SessionMiddleware
        $app->add($this->createSessionMiddleware());

        //Add RoutingMiddleware before MethodOverrideMiddleware so the method is is not overrode before routing
        $app->addRoutingmiddleware();

        //Add MethodOverride middleware for method spoofing
        // e.g. POST request with _METHOD parameter PUT to
        // PUT request
        $app->add($this->createMethodOverrideMiddleware());
        $app->add($this->createSeederMiddleware());

        //Add ErrorMiddleware // this will be the first, bottom to top
        $app->addErrorMiddleware(true, true, false);




    }
    public function createMethodOverrideMiddleware(): MethodOverrideMiddleware
    {
        return new MethodOverrideMiddleware();
    }

    public function createTwigMiddleware(App $app): TwigMiddleware
    {
        return TwigMiddleware::createFromContainer($app, Twig::class);
    }

    public function createSessionMiddleware()
    {
        return SessionMiddleware::class;
    }

    public function createSeederMiddleware()
    {
        return SeederMiddleware::class;
    }
}