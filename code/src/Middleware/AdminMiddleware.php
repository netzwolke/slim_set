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

        if(Auth::isAdmin())
        {
            return $handler->handle($request);;
        }
        else {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $response = $handler->handle($request);
            return $response->withStatus(502)->withHeader('Location',$routeParser->urlFor('home'));

        }
    }

}