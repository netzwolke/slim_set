<?php


namespace App\Factory\Twig;

use App\Auth\Session;

class TwigFunctions
{
    public function example()
    {
        return "Example own Function";
    }
    public function auth() :bool
    {
        return Session::isAuth();
    }
    public function getUser()
    {
        return Session::getUser();
    }

}