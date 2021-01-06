<?php


namespace App\Factory;

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


        $app->put('/user/{id}', [UserController::class, 'update'])->setName('user.update');
        $app->get('/user/{id}/edit', [UserController::class,'edit'])->setName('user.edit');
        $app->get('/user', [UserController::class, 'index'])->setName('user.index');
        $app->post('/user', [UserController::class, 'store'])->setName('user.store');
        $app->get('/user/create', [UserController::class,'create'])->setName('user.create');
        $app->delete('/user/{id}', [UserController::class, 'delete'])->setName('user.delete');
        $app->get('/user/{id}', [UserController::class, 'show'])->setName('user.show');
    }
}
