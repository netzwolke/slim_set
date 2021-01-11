<?php


namespace App\Factory\Twig;

use App\Auth\Session;
use App\Resources\Logger;

class TwigFunctions
{
    public function __construct(Logger $logger)
    {
        $this->Logger = $logger;
    }
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

    public function getErrors()
    {
        return $this->Logger->getErrors();
    }

    public function getSuccesses()
    {
        return $this->Logger->getSuccesses();
    }

}