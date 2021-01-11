<?php


namespace App\Middleware;


use App\Auth\Auth;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;

class AdminMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler):Response
    {
        $response =  $handler->handle($request);

        if(Auth::isAdmin())
        {
            return $response;
        }
        else {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();

            return $response->withStatus(302)->withHeader('Location',$routeParser->urlFor('home'));

        }
    }

}