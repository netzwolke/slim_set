<?php


namespace App\Factory;

use App\Auth\Auth;
use App\Controller\AuthController;
use App\Controller\RoleController;
use App\Controller\UserController;
use App\Middleware\AdminMiddleware;
use App\Resources\Redirect;
use Psr\Container\ContainerInterface;
use Slim\App;
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

        $app->get('/', function ($response, App $app) {
            return $response->withHeader('Location', $app->getRouteCollector()->getRouteParser()->urlFor('user.index'));
        })->setName('home');


        //Auth routes
        $app->post('/login', [AuthController::class, 'login'])->setName('auth.login');
        $app->get('/logout', [AuthController::class, 'logout'])->setName('auth.logout');

        //role routes
        $app->group('/admin', function (RouteCollectorProxy $view) {
            $view->get('/role', [RoleController::class, 'index'])->setName('role.index');
            $view->get('/role/create', [RoleController::class, 'create'])->setName('role.create');
            $view->get('/role/{id}', [RoleController::class, 'show'])->setName('role.show');
            $view->get('/role/{id}/edit', [RoleController::class, 'edit'])->setName('role.edit');
            $view->put('/role/{id}', [RoleController::class, 'update'])->setName('role.update');
            $view->post('/role', [RoleController::class, 'store'])->setName('role.store');
            $view->delete('/role/{id}', [RoleController::class, 'delete'])->setName('role.delete');
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
}
