<?php


namespace App\Factory;


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





    }
}