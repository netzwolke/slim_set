<?php


namespace App\Resources\Output;


use App\Auth\Session;

class Messenger implements OutputMessageInterface
{


    public function check()
    {
        if(!Session::has(self::key))
        {
            Session::set(self::key, new Message());

        }
    }

    /**
     *
     * @return Messenger
     */

    public  static function addError($message)
    {
        self::add(self::Error, $message);
    }
    public static function addWarning($message)
    {
        self::add(self::Warning, $message);
    }
    public static function addSuccess($message)
    {
        self::add(self::Success, $message);
    }

    public static function add($type, $message)
    {
        self::check();
        $MessageClass = Session::get(self::key);
        $MessageClass->add($type, $message);
    }

    public static function get($type)
    {
        self::check();
        //Get Message in Session
        $message =  Session::get(self::key);

        //Get Type of Message
        return $message->get($type);
    }

    public static function has($type): bool
    {
        self::check();
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

    public static function clear($type)
    {
        self::check();
        //get Message in Session
        $message = Session::get(self::key);

        //Clear Message Array for $type
        $message->clear($type);
    }
}