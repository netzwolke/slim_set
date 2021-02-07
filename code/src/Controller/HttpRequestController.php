<?php


namespace App\Controller;


use App\Model\HttpRequest;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;

class HttpRequestController
{
    public function index($response, Twig $twig)
    {
        $requests = HttpRequest::all();
        return $twig->render($response, 'res/httpRequest/index.twig', compact('requests'));
    }

    public function show($response, $id, Twig $twig)
    {
        $request = HttpRequest::find($id);
        return $twig->render($response, 'res/httpRequest/show.twig',compact('request'));
    }

    public function create($response, Twig $twig)
    {
        return $twig->render($response, 'res/httpRequest/create.twig');
    }

    public function edit($response, $id, Twig $twig)
    {
        $request = HttpRequest::find($id);
        return $twig->render($response, 'res/httpRequest/edit.twig',compact('request'));
    }

    public function store(ServerRequestInterface $request, $response, RouteParserInterface $parser)
    {
        $store = $request->getParsedBody();
        HttpRequest::create($store);
        return $response->withStatusCode(302)->withHeader('location',$parser->urlFor('httpRequest.index'));
    }

    public function update(ServerRequestInterface $request, $id, $response, RouteParserInterface $parser)
    {
        $update = $request->getParsedBody();
        $request = HttpRequest::find($id);
        $request->fill($update);
        $request->save();
        return $response->withStatusCode(302)->withHeader('location',$parser->urlFor('httpRequest.index'));
    }
}