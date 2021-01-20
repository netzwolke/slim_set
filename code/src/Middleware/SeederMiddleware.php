<?php


namespace App\Middleware;

use App\Resources\Seeder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class SeederMiddleware
{
    public function __construct(Seeder $seeder)
    {
        $this->seeder = $seeder;
    }

    public function __invoke(Request $request, RequestHandler $handler):ResponseInterface
    {

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('seeder.index');
        $response = new Response();

        if(($this->seeder->isNeeded()) && ! (strpos( $url, $request->getUri()) === false) )
        {
            return $response->withStatus(502)->withHeader('Location', $url);
        }
        return $handler->handle($request);
    }
}