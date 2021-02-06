<?php


namespace App\Factory\Twig;

use App\Auth\Session;
use App\Resources\Output\Messenger;

class TwigFunctions
{
    /**
     * @var Messenger
     */

    public function example(): string
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

    public function hasMessage($type): bool
    {
        return Messenger::has($type);
    }

    public function getMessage($type)
    {
        $message =  Messenger::get($type);
        Messenger::clear($type);
        return $message;
    }


}