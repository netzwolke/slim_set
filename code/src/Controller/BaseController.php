<?php


namespace App\Controller;


use DI\Container;

class BaseController
{

    protected $container;

    public function __construct(Container $container){
        $this->container = $container;
    }
}