<?php


namespace App\Factory;



use App\DB\DatabaseInterface;
use App\Resources\Message;
use Psr\Container\ContainerInterface;

class Settings
{
    public function __construct($container)
    {

        $this->setSettings($container);
    }
    private function setSettings($container)
    {
        $container->set(
            'settings',
            [
                'view'=>[
                    'path'=> '../src/View',
                    'settings'=>['cache'=>false]
                ],
                'env' => DatabaseInterface::ENV_STG,
                'db' => [
                    DatabaseInterface::ENV_STG =>[
                            'driver'=>'mysql',
                            'host' => 'database',
                            'database' => DatabaseInterface::DB_STG,
                            'username' => 'root',
                            'password' => '123456',
                            'charset'   => 'utf8',
                            'collation' => 'utf8_unicode_ci',
                            'prefix'    => '',
                            ],
                    DatabaseInterface::ENV_PROD =>[
                        'driver'=>'mysql',
                        'host' => 'database',
                        'database' => DatabaseInterface::ENV_PROD,
                        'username' => 'root',
                        'password' => '123456',
                        'charset'   => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                        'prefix'    => '',
                    ],
                    'base' => [
                        'driver'=>'mysql',
                        'host' => 'database',
                        'database' => '',
                        'username' => 'root',
                        'password' => '123456',
                        'charset'   => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                        'prefix'    => '',
                    ]

                ]
            ]
        );
    }

}