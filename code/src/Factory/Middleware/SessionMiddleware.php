<?php


namespace App\Factory\Middleware;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Factory\Auth\Session;

class SessionMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler):Response
    {
        $response = $handler->handle($request);

        Session::startSession();

        return $response;
    }
    public function __construct()
    {
        Session::startSession();
    }
}