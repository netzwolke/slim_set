<?php
declare(strict_types=1);

namespace App\Resources;


use App\Auth\Session;

class History
{
    public const history = '__History__';

    public function __construct(array $urls = [])
    {
        if(!Session::has(self::history)){
            Session::set(self::history, $urls);
        }
    }
    public function addUrl($url)
    {
        Session::add(self::history, $url);
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
            $urls .= $url . " |";
        }
        return $urls;
    }

    public function getLastUrl()
    {
        $urls = Session::get(self::history);
        return end($urls);
    }
}