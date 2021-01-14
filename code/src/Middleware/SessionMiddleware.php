<?php


namespace App\Middleware;

use App\Resources\History;
use App\Resources\Output\Messenger;
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
    /**
     * @var Messenger
     */
    private Messenger $messenger;

    public function __construct(History $history, Messenger $messenger)
    {
        $this->messenger = $messenger;
        $this->history = $history;
    }
    public function __invoke(Request $request, RequestHandler $handler):Response
    {
        //Start Session
        Session::startSession();

        //first Handle the Request
        $response = $handler->handle($request);

        //save Browsing history
        $this->history->check($request, $response);

        return $response;
    }

}