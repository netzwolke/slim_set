<?php


namespace App\Middleware;


use App\Resources\Seeder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class SeederMiddleware
{
    /**
     * @var Seeder
     */
    private Seeder $seeder;

    public function __construct(Seeder $seeder)
    {
        $this->seeder = $seeder;

    }
    public function __invoke(Request $request, RequestHandler $handler):Response
    {

        return $handler->handle($request);
    }
}