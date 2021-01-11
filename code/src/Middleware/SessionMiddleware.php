<?php


namespace App\Middleware;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Auth\Session;

class SessionMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler):Response
    {
        Session::startSession();

        return $handler->handle($request);
    }

}