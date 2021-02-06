<?php


namespace App\Controller\API;


use App\Model\Role;
use Psr\Http\Message\ResponseInterface;

class ApiRoleController
{
    public function index(ResponseInterface $response)
    {
        $roles = Role::all()->toJson();
        $response->getBody()->write($roles);
        return $response->withHeader('Content-type','application/json');
    }
}