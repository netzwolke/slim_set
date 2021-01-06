<?php


namespace App\Factory;

use App\Controller\RoleController;
use App\Controller\UserController;
use Slim\App;

class Routes
{
    public function __construct(App $app)
    {
        $this->setRoutes($app);
    }


    public function setRoutes(App $app)
    {

        $app->get('/', function ($response, App $app) {
            return $response->withHeader('Location', $app->getRouteCollector()->getRouteParser()->urlFor('user.index'));
        })->setName('home');


        //role routes
        $app->get('/role', [RoleController::class, 'index'])->setName('role.index');
        $app->get('/role/create', [RoleController::class, 'create'])->setName('role.create');
        $app->get('/role/{id}', [RoleController::class, 'show'])->setName('role.show');
        $app->get('/role/{id}/edit', [RoleController::class, 'edit'])->setName('role.edit');
        $app->put('/role/{id}', [RoleController::class, 'update'])->setName('role.update');
        $app->post('/role', [RoleController::class, 'store'])->setName('role.store');
        $app->delete('/role/{id}', [RoleController::class, 'delete'])->setName('role.delete');

        //user routes
        $app->put('/user/{id}', [UserController::class, 'update'])->setName('user.update');
        $app->get('/user/{id}/edit', [UserController::class,'edit'])->setName('user.edit');
        $app->get('/user', [UserController::class, 'index'])->setName('user.index');
        $app->post('/user', [UserController::class, 'store'])->setName('user.store');
        $app->get('/user/create', [UserController::class,'create'])->setName('user.create');
        $app->get('/user/{id}', [UserController::class, 'show'])->setName('user.show');
        $app->delete('/user/{id}', [UserController::class, 'delete'])->setName('user.delete');
    }
}
