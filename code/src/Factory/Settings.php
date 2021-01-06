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
                ],
                'db'=>[
                    'driver'=>'mysql',
                    'host' => 'database',
                    'database' => 'Example',
                    'username' => 'root',
                    'password' => '123456',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                ]
            ]
        );
    }
}