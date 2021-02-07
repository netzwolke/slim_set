<?php


namespace App\Factory;



use App\DB\DatabaseInterface;

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
                'env' => include_once('../env'),
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
                        'database' => DatabaseInterface::DB_PROD,
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