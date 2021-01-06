<?php


namespace App\Factory\Twig;

use App\Factory\Auth\Session;

class TwigFunctions
{
    public function example()
    {
        return "Example own Function";
    }
    public function auth($user) :bool
    {
        return false;
    }
    public function getUser()
    {
        return Session::getUser();
    }

}