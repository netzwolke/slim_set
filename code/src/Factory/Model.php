<?php


namespace App\Factory;


use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Connectors\ConnectionFactory as IlluminateConnectionFactory;
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
        $settings = $config['DB'];
        $container = new IlluminateContainer();
        $connFactory = new IlluminateConnectionFactory($container);
        $conn = $connFactory->make($settings);
        $resolver = new ConnectionResolver();
        $resolver->addConnection('default', $conn);
        $resolver->setDefaultConnection('default');
        IlluminateModel::setConnectionResolver($resolver);
    }
}