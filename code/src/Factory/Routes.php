<?php


namespace App\Factory;


use App\Controller\ExampleController;

class Routes
{
    public function  __construct($app)
    {
        $this->setRoutes($app);
    }


    public function setRoutes($app)
    {

        $app->get('/', function ($response) {
            $response->getBody()->write("Hello world!");
            return $response;
        });
        $app->get('/{name}',[ExampleController::class,'index']);
        $app->get('/dash/{name}',[ExampleController::class,'dash']);




    }
}