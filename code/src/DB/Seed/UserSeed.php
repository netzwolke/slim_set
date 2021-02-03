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
               'password' => '$2y$12$eRjffdn.KuPHDvTdZCAXc..LOfeMbMIX1rt7HjTbKm\/9CsJoedyky',
               'roleId' => 1
           ], [
               'name'=>'user',
               'password'=>'$2y$12$h7s8D372V2BXGbbZY5RlUe8N9C.iQNQiEDkYJXKnaqO00i1UIg9gK',
               'roleId' => 2
           ], [
               'name'=>'guest',
               'password'=>'$2y$12$lOM8elzwuL\/BN81xbEOrmupFXhPFPyqsdMGsfsvWnKTILwG\/Ks8Oy',
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
