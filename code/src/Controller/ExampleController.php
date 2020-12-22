<?php


namespace App\Controller;


class ExampleController extends BaseController
{
    public function index($response,$name)
    {

        $response->getBody()->write("Hello dear $name");
        return $response;
    }
}