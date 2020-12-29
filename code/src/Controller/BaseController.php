<?php


namespace App\Controller;


use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

class BaseController
{

    protected $container;
    /**
     * @var view
     */
    protected $twig;
    /**
     * @var App
     */
    protected $app;

}