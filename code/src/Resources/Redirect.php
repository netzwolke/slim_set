<?php


namespace App\Resources;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

class Redirect
{
    /**
     * @var ServerRequestInterface
     */
    private $request;
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    public function toUrl(String $url): ResponseInterface
    {
        $parser = RouteContext::fromRequest($this->request)->getRouteParser();
        return $this->response->withHeader('Location', $parser->urlFor($url));
    }
}
