<?php


namespace App\Controller;


use App\Model\HttpRequest;
use Slim\Views\Twig;

class HttpRequestController
{
    public function index($response, Twig $twig)
    {
        $requests = HttpRequest::all();
        return $twig->render($response, 'res/httpRequest/index.twig', compact('requests'));
    }
}