<?php


namespace App\Factory;



class Settings
{
    public function __construct($container)
    {

        $this->setSettings($container);
    }
    public function setSettings($container)
    {
        $container->set(
            'settings',
            [
                'view'=>[
                    'path'=> '../src/View',
                    'settings'=>['cache'=>false]
                ]
            ]
        );
    }
}