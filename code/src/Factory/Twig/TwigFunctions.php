<?php


namespace App\Factory\Twig;

use App\Auth\Session;
use App\Resources\Output\Messenger;

class TwigFunctions
{
    /**
     * @var Messenger
     */
    private Messenger $messenger;

    public function __construct(Messenger $messenger)
    {
        $this->messenger = $messenger;
    }
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
        return $this->messenger->has($type);
    }

    public function getMessage($type)
    {
        $message =  $this->messenger->get($type);
        $this->messenger->clear($type);
        return $message;
    }


}