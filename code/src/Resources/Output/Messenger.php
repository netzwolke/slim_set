<?php


namespace App\Resources\Output;


use App\Auth\Session;

class Messenger implements OutputMessageInterface
{


    public function __construct(Message $message)
    {
            Session::set(self::key, $message);
    }

    /**
     *
     * @return Messenger
     */
    public static function create(): self
    {
        return new self(new Message());
    }

    public function addError($message)
    {
        $this->add(self::Error, $message);
    }
    public function addDanger($message)
    {
        $this->add(self::Danger, $message);
    }
    public function addSuccess($message)
    {
        $this->add(self::Success, $message);
    }

    public function add($type, $message)
    {
        $MessageClass = Session::get(self::key);
        $MessageClass->add($type, $message);
    }

    public function get($type)
    {
        //Get Message in Session
        $message =  Session::get(self::key);

        //Get Type of Message
        $output = $message->get($type);

        //Clear Message Array
        $message->clear($type);
        return $output;
    }

    public function has($type): bool
    {
        //Get Message in Session
        $message =  Session::get(self::key);

        //Get Type of Message
        $output = $message->get($type);
        if($output)
        {
            return true;
        }
        return false;

    }
}