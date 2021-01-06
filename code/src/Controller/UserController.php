<?php


namespace App\Controller;

use App\Model\Role;
use App\Model\User;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UserController
{


    public function edit($response, $id, Twig $twig): ResponseInterface
    {
        $user = User::find($id);
        $users [] = $user;
        $roles = Role::all();

        try {
            return $twig->render($response, 'user/edit.twig', compact('users','roles'));
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }

    public function index($response, Twig $twig): ResponseInterface
    {
        $users = User::all();
        try {
            return $twig->render($response, 'user/index.twig', compact("users"));
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
    public function update($request, $response, $id, App $app)
    {
        // Find User
        $user = User::find($id);

        // Get Post Array
        $update = $request->getParsedBody();

        // Update User with Array
        $user->fill($update);
        $user->save();

        //Redirect to Index
        return $response->withHeader('Location', $app->getRouteCollector()->getRouteParser()->urlFor('user.index'));
    }

    public function create($response, Twig $twig)
    {
        $roles = Role::all();
        return $twig->render($response, 'user/create.twig', compact('roles'));
    }

    public function store($request, $response, App $app)
    {
        $create = $request->getParsedBody();
        User::create($create);
        return $response->withHeader('Location', $app->getRouteCollector()->getRouteParser()->urlFor('user.index'));
    }

    public function delete($response, $id, App $app)
    {
        User::destroy($id);
        return $response->withHeader('Location', $app->getRouteCollector()->getRouteParser()->urlFor('user.index'));
    }

    public function show($response, $id, Twig $twig)
    {
        $user = User::find($id);

        return $twig->render($response, 'user/show.twig',compact('user'));
    }
}
