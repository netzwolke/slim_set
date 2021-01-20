<?php
declare(strict_types=1);

namespace App\Controller;


use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;

class SeederController
{
    public function index($response, Twig $twig)
    {
        $name = null;
        $pattern = 'role';
        if(is_null($name))
        {
            $name = $pattern;
        }

        if(!(strpos($name, '/') === false)){

            $name_ref = explode('/', $name);
            $name_ref = array_slice($name_ref, 1);
            $name = implode('.', $name_ref);
        }
        $test = $name . '.index';

        return $twig->render($response, 'seeder/index.twig',compact('test'));
    }
    public function seed($request, $response, RouteParserInterface $parser)
    {
        $create = $request->getParsedBody();
        $config = Config::create();
        $config->name = $create['name'];
        $config->settings = $create['settings'];
        $config->save();
        return $response->withStatus(503)->withHeader('Location', $parser->urlFor("home"));
    }

    public function admin()
    {

    }
}