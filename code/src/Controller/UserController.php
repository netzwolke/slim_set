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



    public function index($response, Twig $twig, Messenger $messenger, History $history): ResponseInterface
    {

        $messenger->add('Error','titit');
        $messenger->add(Messenger::Danger,'titit');
        $messenger->add(Messenger::Success,'titit');
        $messenger->addSuccess($history->getUrlStrings());
        $users = User::all();

        return $twig->render($response, 'user/index.twig', compact("users"));
    }

    public function edit($response, $id, Twig $twig): ResponseInterface
    {
        $user = User::find($id);
        $roles = Role::all();

        return $twig->render($response, 'user/edit.twig', compact('user', 'roles'));
    }
    public function update($request, $response, $id, RouteParserInterface $parser)
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

        return $response->withHeader('Location', $parser->urlFor('user.index'));
    }

    public function create($response, Twig $twig): ResponseInterface
    {
        $roles = Role::all();
        return $twig->render($response, 'user/create.twig', compact('roles'));
    }

    public function store(ServerRequestInterface $request, $response, RouteParserInterface $parser): ResponseInterface
    {
        $create = $request->getParsedBody();
        $password = $create['password'];
        $create['password'] = password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);
        User::create($create);

        return $response->withHeader('Location', $parser->urlFor('user.index'));
    }

    public function delete($request, $response, $id, RouteParserInterface $parser)
    {
        User::destroy($id);
        return $response->withHeader('Location', $parser->urlFor('user.index'));
    }

    public function show($response, $id, Twig $twig)
    {
        $user = User::find($id);
        return $twig->render($response, 'user/show.twig', compact('user'));
    }
}
