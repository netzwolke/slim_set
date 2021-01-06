<?php


namespace App\Controller;


use App\Interfaces\Controller;
use App\Model\Role;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;

class RoleController
{

    /**
     * @return ResponseInterface
     */
    public function index($response, Twig $twig): ResponseInterface
    {
        $roles = Role::all();
        return $twig->render($response, 'role/index.twig',compact('roles'));
    }

    public function show($response, $id, Twig $twig)
    {
        $role = Role::find($id);
        return $twig->render($response, 'role/show.twig',compact('role'));
    }

    /**
     * @return ResponseInterface
     */
    public function create(): ResponseInterface
    {
        // TODO: Implement create() method.
    }

    /**
     * @return ResponseInterface
     */
    public function store(): ResponseInterface
    {
        // TODO: Implement store() method.
    }

    /**
     * @return ResponseInterface
     */
    public function edit(): ResponseInterface
    {
        // TODO: Implement edit() method.
    }

    /**
     * @return ResponseInterface
     */
    public function update(): ResponseInterface
    {
        // TODO: Implement update() method.
    }

    /**
     * @return ResponseInterface
     */
    public function delete(): ResponseInterface
    {
        // TODO: Implement delete() method.
    }
}