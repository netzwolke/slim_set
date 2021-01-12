<?php


namespace App\Controller;

use App\Model\Role;
use Psr\Http\Message\ResponseInterface;
use Slim\Routing\RouteContext;
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
    public function create($response, Twig $twig): ResponseInterface
    {
        return $twig->render($response, 'role/create.twig');
    }

    /**
     * @return ResponseInterface
     */
    public function store($request, $response): ResponseInterface
    {
        $create = $request->getParsedBody();
        Role::create($create);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('role.index');
        return $response->withHeader('Location', $url);
    }

    /**
     * @return ResponseInterface
     */
    public function edit($response, $id, Twig $twig): ResponseInterface
    {
        $role = Role::find($id);
        return $twig->render($response, 'role/edit.html.twig',compact('role'));
    }

    /**
     * @return ResponseInterface
     */
    public function update($request, $response, $id): ResponseInterface
    {
        $role = Role::find($id);
        $update = $request->getParsedBody();
        $role->fill($update);
        $role->save();

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('role.index');
        return $response->withHeader('Location', $url);
    }

    /**
     * @return ResponseInterface
     */
    public function delete($request, $response, $id): ResponseInterface
    {
        Role::destroy($id);
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('role.index');
        return $response->withHeader('Location', $url);
    }
}