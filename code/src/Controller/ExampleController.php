<?php


namespace App\Controller;


use Slim\Views\Twig;

class ExampleController extends BaseController
{
    public function index($response,$name)
    {

        $response->getBody()->write("Hello dear $name");
        return $response;
    }
    public function dash($response,$name)
    {
        return $this->container->get('view')->render($response,'example/index.twig',compact('name'));
    }
}