<?php


namespace App\Factory;



use Slim\Views\Twig;

class Views
{
    public function __construct($container)
    {
        $container->set('views', $this->createTwig($container));
    }
    public function createTwig($container)
    {
        $settings = $container->get('settings')['view'];
        return Twig::create($settings['path'],$settings['settings']);
    }
}