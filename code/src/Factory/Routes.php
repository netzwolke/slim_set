<?php


namespace App\Factory;


use App\Controller\ExampleController;
use DI\Bridge\Slim\Bridge;
use Slim\App;
use Slim\Views\TwigMiddleware;

class Routes
{
    public function  __construct($app)
    {
        $this->setRoutes($app);
    }


    public function setRoutes(App $app)
    {

        $app->get('/', function ($response) {
            $response->getBody()->write("Hello world!");
            return $response;
        })->setName('home');
        $app->get('/{name}',[ExampleController::class,'index']);
        $app->get('/dash/{name}',[ExampleController::class,'dash']);




    }
}