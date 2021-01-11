<?php


namespace App\Auth;

use App\Model\User;

class Auth
{
    public static function login($name, $password)
    {
        $users = User::where('name', $name)->get();
        $user = $users[0];
        if(password_verify($password,$user->password)){
            Session::setUser($user->name);
            Session::setAuth();
        }


    }

    public static function getUser()
    {
        $name = Session::getUser();
        $users = User::where('name',$name)->get();
        return $users[0];
    }
    public static function isAdmin()
    {
        $user = self::getUser();
        if($user->role->name === "Admin")
        {
            return true;
        }
        return false;
    }

    public static function logout()
    {
        Session::destroySession();
    }
}
