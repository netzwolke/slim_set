<?php


namespace App\Controller;

use App\Model\Role;
use App\Model\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\Psr17\ServerRequestCreator;
use Slim\Interfaces\RouteParserInterface;
use Slim\Routing\RouteContext;
use Slim\Routing\RouteParser;
use Slim\Views\Twig;

class UserController
{


    public function edit($response, $id, Twig $twig): ResponseInterface
    {
        $user = User::find($id);
        $roles = Role::all();

        return $twig->render($response, 'user/edit.twig', compact('user', 'roles'));
    }

    public function index($response, Twig $twig): ResponseInterface
    {

        $users = User::all();
        return $twig->render($response, 'user/index.twig', compact("users"));
    }
    public function update($request, $response, $id)
    {
        // Find User
        $user = User::find($id);

        // Get Post Array
        $update = $request->getParsedBody();

        // Update User with Array
        $user->fill($update);
        // Generate Hash Password
        $user->setPassword($update['password']);
        $user->save();

        //Redirect to Index
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('user.index');
        return $response->withHeader('Location', $url);
    }

    public function create($response, Twig $twig)
    {
        $roles = Role::all();
        return $twig->render($response, 'user/create.twig', compact('roles'));
    }

    public function store(ServerRequestInterface $request, $response): ResponseInterface
    {
        $create = $request->getParsedBody();
        $password = $create['password'];
        $create['password'] = password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);
        User::create($create);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('user.index');
        return $response->withHeader('Location', $url);
    }

    public function delete($request, $response, $id)
    {
        User::destroy($id);
        $routeParser = $request->getAttribute(RouteContext::ROUTE_PARSER);
        $url = $routeParser->urlFor('user.index');
        return $response->withHeader('Location', $url);
    }

    public function show($response, $id, Twig $twig)
    {
        $user = User::find($id);
        return $twig->render($response, 'user/show.twig', compact('user'));
    }
}
