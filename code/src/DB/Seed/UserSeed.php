<?php

namespace App\DB\Seed;

use App\DB\SeedInterface;
use App\Model\User;

class UserSeed implements SeedInterface
{
    public function default() : array
    {
       return [
           [
               'name'=> 'root',
               'password' => 'toor',
               'roleId' => 1
           ], [
               'name'=>'user',
               'password'=>'user',
               'roleId' => 2
           ], [
               'name'=>'guest',
               'password'=> 'guest',
               'roleId'=>3,
           ]
       ];
    }

    public function run(array $seeds) :void
    {
        foreach($seeds as $seed)
        {
            User::create($seed);
        }
    }
}
