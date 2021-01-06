<?php


namespace App\Factory;


use Illuminate\Container\Container;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\Eloquent\Model as IlluminateModel;
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
        $settings = $config['db'];
        $container = new Container;
        $connFactory = new ConnectionFactory($container);
        $conn = $connFactory->make($settings);
        $resolver = new ConnectionResolver();
        $resolver->addConnection('default', $conn);
        $resolver->setDefaultConnection('default');
        IlluminateModel::setConnectionResolver($resolver);
    }
}