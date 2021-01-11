<?php


namespace App\Controller;


use App\Auth\Auth;
use Psr\Http\Message\ResponseInterface;
use Slim\Routing\RouteContext;

class AuthController
{
    public function login($request, $response) : ResponseInterface
    {
        $form = $request->getParsedBody();

        Auth::login($form['name'], $form['password']);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('home');

        return $response->withHeader('Location', $url);
    }

    public function logout($request, $response) : ResponseInterface
    {

        Auth::logout();


        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('home');

        return $response->withHeader('Location', $url);
    }
}