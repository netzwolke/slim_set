<?php
declare(strict_types=1);

namespace App\Controller;


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
    public function seed()
    {

    }

    public function update()
    {

    }
}