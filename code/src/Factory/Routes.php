<?php


namespace App\Factory;

use App\Auth\Auth;
use App\Controller\AuthController;
use App\Controller\RoleController;
use App\Controller\SeederController;
use App\Controller\UserController;
use App\Middleware\AdminMiddleware;
use App\Resources\Output\Messenger;
use App\Resources\Redirect;
use phpDocumentor\Reflection\Types\ClassString;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Routing\RouteCollectorProxy;

class Routes
{
    public function __construct(App $app)
    {
        $this->setRoutes($app);
        $this->setRouteParser($app);
    }

    public function setRouteParser(App $app)
    {
        $app->getContainer()->set(RouteParserInterface::class, $app->getRouteCollector()->getRouteParser());
    }


    public function setRoutes(App $app)
    {

        $app->get('/name/{name}', function(ResponseInterface $response, $name) {
           $response->getBody()->write("Hello dear $name");
           return $response;
        });

        $app->get('/', function ($response, App $app) {
            return $response->withHeader('Location', $app->getRouteCollector()->getRouteParser()->urlFor('user.index'));
        })->setName('home');

        //Seeder routes

        $app->get('/seeder', [SeederController::class, 'index'])->setName('seeder.index');


        //Auth routes
        $app->post('/login', [AuthController::class, 'login'])->setName('auth.login');
        $app->get('/logout', [AuthController::class, 'logout'])->setName('auth.logout');

        //role routes
        $app->group('/admin', function (RouteCollectorProxy $view) {
            $this->resources($view, '/seeder', SeederController::class, ['name' => 'admin.seeder','only'=>['index','show']]);

            $this->resources($view, '/role', RoleController::class, ['name' => 'role']);



        })->add(AdminMiddleware::class);

        //user routes
        $app->get('/user', [UserController::class, 'index'])->setName('user.index');
        $app->get('/user/create', [UserController::class,'create'])->setName('user.create');
        $app->get('/user/{id}/edit', [UserController::class,'edit'])->setName('user.edit');
        $app->get('/user/{id}', [UserController::class, 'show'])->setName('user.show');
        $app->put('/user/{id}', [UserController::class, 'update'])->setName('user.update');
        $app->post('/user', [UserController::class, 'store'])->setName('user.store');
        $app->delete('/user/{id}', [UserController::class, 'delete'])->setName('user.delete');
    }
    public function resources(RouteCollectorProxyInterface $app, string $pattern, string $callable, array $options = null)
    {
        $resources = [
            'index' => ['','get'],
            'create' => ['/create','get'],
            'edit' => ['/{id}/edit','get'],
            'show' => ['/{id}','get'],
            'update' => ['/{edit}','put'],
            'store' => ['','post'],
            'delete' => ['/{id}','delete']
        ];
        $routes = [
            'index',
            'create',
            'edit',
            'show',
            'update',
            'store',
            'delete',

        ];

        $name = isset($options['name']) ? $options['name'] : null;
        $only = isset($options['only']) ? $options['only'] : $routes;

        if(is_null($name))
        {
            $name = $pattern;
        }

        if(!(strpos($name, '/') === false)){
            $name_ref = explode('/', $name);
            $name_ref = array_slice($name_ref, 1);
            $name = implode('.', $name_ref);
        }

        foreach ($only as $route)
        {
            call_user_func([$app, $resources[$route][1]], $pattern . $resources[$route][0], [$callable, $route])->setName($name . '.' . $route);
        }
        /* // Style
        $app->get($pattern, [$callable, 'index'])->setName($name . '.index');
        $app->get($pattern . '/create', [$callable, 'create'])->setName($name . '.create');
        $app->get($pattern . '/{id}/edit', [$callable,'edit'])->setName($name . '.edit');
        $app->get($pattern . '/{id}', [$callable, 'show'])->setName($name . '.show');
        $app->put($pattern . '/{id}', [$callable, 'update'])->setName($name . '.update');
        $app->post($pattern, [$callable, 'store'])->setName($name . '.store');
        $app->delete($pattern . '/{id}', [$callable, 'delete'])->setName($name . '.delete');
        */
    }
}
