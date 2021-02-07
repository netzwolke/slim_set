<?php


namespace App\Controller;

use App\Auth\Session;
use App\Model\Role;
use App\Model\User;
use App\Resources\History;
use App\Resources\Output\Messenger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;

class UserController
{



    public function index($response, Twig $twig): ResponseInterface
    {

        $users = User::all();
        Messenger::addSuccess(include_once('../env'));
        return $twig->render($response, 'user/index.twig', compact("users"));
    }

    public function edit($response, $id, Twig $twig): ResponseInterface
    {
        $user = User::find($id);
        $roles = Role::all();
        return $twig->render($response, 'user/edit.twig', compact('user', 'roles'));
    }
    public function update($request,ResponseInterface $response, $id, RouteParserInterface $parser)
    {
        // Find User
        $user = User::find($id);

        // Get Post Array
        $update = $request->getParsedBody();


        // Update User with Array
        $user->fill($update);

        $user->save();
        //Redirect to Index

        return $response->withHeader('Location', $parser->urlFor('user.index'))->withStatus(302);
    }

    public function create($response, Twig $twig): ResponseInterface
    {
        $roles = Role::all();
        return $twig->render($response, 'user/create.twig', compact('roles'));
    }

    public function store(ServerRequestInterface $request, $response, RouteParserInterface $parser): ResponseInterface
    {
        $create = $request->getParsedBody();
        User::create($create);

        return $response->withHeader('Location', $parser->urlFor('user.index'))->withStatus(302);
    }

    public function delete($request, $response, $id, Messenger $messenger, RouteParserInterface $parser)
    {
        $user = User::find($id);
        User::destroy($id);
        $messenger->addSuccess("User: $user->name deleted!");
        return $response->withHeader('Location', $parser->urlFor('user.index'))->withStatus(302);
    }

    public function show($response, $id, Twig $twig)
    {
        $user = User::find($id);
        return $twig->render($response, 'user/show.twig', compact('user'));
    }
}
