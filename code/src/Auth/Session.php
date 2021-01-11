<?php


namespace App\Auth;

use App\Model\User;

class Session
{
    public static function destroySession()
    {
        session_destroy();
    }
    public static function startSession()
    {
        session_start();
        if (! self::isAuth()) {
            self::setUser('guest');
        }
    }
    public static function setUser($user): bool
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION['user'] = $user;
        }
        return false;
    }
    public static function setAuth()
    {
        $_SESSION['auth'] = true;
    }

    public static function isAuth(): bool
    {
        if (isset($_SESSION['auth'])) {
            return true;
        }
        return false;
    }
    public static function getUser()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return $_SESSION['user'];
        }
        return $_SESSION['user'];
    }
}