<?php


namespace App\Factory;


use Illuminate\Database\Capsule\Manager;
use Psr\Container\ContainerInterface;


class Model
{
    public function __construct(ContainerInterface $container)
    {
        $this->createEloquent($container);
    }

    public function createEloquent(ContainerInterface $container)
    {
        $config = $container->get('settings');
        $env = $config['env'];
        $databases = $config['db'];

        $capsule = new Manager();
        foreach ($databases as $key => $database)
        {

            if($key === $env)
            {
                $capsule->addConnection($database, 'default');
            }
            $capsule->addConnection($database, $key);

        }
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}