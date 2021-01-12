<?php


namespace App\Resources\Output;


use App\Auth\Session;

class Messenger implements OutputMessageInterface
{


    public function __construct(Message $message)
    {
        if(!Session::has(self::key))
        {
            Session::set(self::key, $message);

        }
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
    public function addWarning($message)
    {
        $this->add(self::Warning, $message);
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
        return $message->get($type);
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

    public function clear($type)
    {
        //get Message in Session
        $message = Session::get(self::key);

        //Clear Message Array for $type
        $message->clear($type);
    }
}