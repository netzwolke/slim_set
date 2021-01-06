<?php


namespace App\Factory\Auth;


use App\Model\User;

class Session
{
    public static function  startSession()
    {
        session_start();
        self::setUser('guest');
    }
    public static function setUser($user)
    {
        if(session_status() === PHP_SESSION_ACTIVE)
        {
            $_SESSION['user'] = $user;
        }
        return false;
    }
    public static function getUser()
    {
        if(session_status() == PHP_SESSION_ACTIVE)
        {
            return $_SESSION['user'];
        }
        return $_SESSION['user'];
    }
}