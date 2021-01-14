<?php
declare(strict_types=1);

namespace App\Resources;


use App\Auth\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class History
{
    public const history = '__History__';

    public function __construct(array $urls = [])
    {
        if(!Session::has(self::history)){
            Session::set(self::history, $urls);
        }
    }
    public function addUrl(string $url)
    {
            Session::add(self::history, $url);
    }
    public function check(ServerRequestInterface $request, ResponseInterface $response)
    {
        //make sure request is a GET method
        if($request->getMethod() == 'GET')
        {
            //make sure response comes with successful status code
            if($response->getStatusCode() >=  200 && $response->getStatusCode() < 300)
                $this->addUrl($request->getUri()->getPath());
        }
    }

    public function getUrls()
    {
        return Session::get(self::history);
    }

    public function getUrlStrings(): string
    {
        $urls = '';
        foreach(Session::get(self::history) as $url)
        {
            $urls .= $url . " ||";
        }
        return $urls;
    }

    public function getLastUrl()
    {
        $urls = Session::get(self::history);
        return end($urls);
    }
}