<?php


namespace App\Middleware;

use App\DB\Migrator;
use App\DB\Seeder;
use Illuminate\Database\Capsule\Manager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class SeederMiddleware
{
    /**
     * @var Seeder
     */
    private Seeder $seeder;
    /**
     * @var Migrator
     */
    private Migrator $migrator;
    /**
     * @var mixed|env
     */
    private $env;
    /**
     * @var mixed
     */
    private $db;

    public function __construct(ContainerInterface $container, Seeder $seeder, Migrator $migrator)
    {
        $this->seeder = $seeder;
        $this->migrator = $migrator;
        $settings = $container->get('settings');
        $this->env = $settings['env'];
        $this->db = $settings['db'][$this->env]['database'];
    }

    public function __invoke(Request $request, RequestHandler $handler):ResponseInterface
    {
        if($this->DBisEmpty())
        {
            $this->createDB();
            $this->startMigrations();
            $this->startSeeds();
        }
        return $handler->handle($request);
    }

    public function DBisEmpty() : bool
    {
        $array = Manager::schema('base')->getConnection()->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$this->db';");
        if(count($array) > 0)
        {
            return false;
        }
        return true;
    }

    public function createDB()
    {
        $result = Manager::schema('base')->getConnection()->statement("CREATE DATABASE IF NOT EXISTS $this->db;");
    }

    public function startMigrations()
    {
        $this->migrator->run();
    }
    
    public function startSeeds()
    {
        $this->seeder->run();
    }
    
}