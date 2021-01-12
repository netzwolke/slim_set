<?php


namespace App\Middleware;

use App\Resources\History;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Auth\Session;

class SessionMiddleware
{

    /**
     * @var History
     */
    private History $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }
    public function __invoke(Request $request, RequestHandler $handler):Response
    {
        //Start Session
        Session::startSession();

        //save Browsing history
        if($request->getMethod() == 'GET')
        {
            $this->history->addUrl($request->getUri());
        }

        return $handler->handle($request);
    }

}