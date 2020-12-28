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
     * @var Twig
     */
    protected $twig;
    /**
     * @var App
     */
    protected $app;

    public function __construct(ContainerInterface $container, Twig $twig,  App $app){
        $this->container = $container;
        $this->twig = $twig;
        $this->app = $app;
        //$this->app->getContainer()->set('view',$this->twig);
        $this->app->add(TwigMiddleware::create($this->app,$this->twig));
    }
}