<?php


namespace App\Controller;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;

class ExampleController extends BaseController
{
    public function index($response,$name)
    {

        $response->getBody()->write("Hello dear $name");
        return $response;
    }

    public function dash($response,$name, Twig $sd, ContainerInterface $container)
    {
        $names = [
            ["name"=>"Peter",
            "rolle"=>"Master",
                ],
            [
                'name'=>'Ullrich',
                'rolle'=>'Commander',
            ]
        ];
        $test = $container->get('settings');
        return $sd->render($response,'example/index.twig',compact('names','test'));
    }
}