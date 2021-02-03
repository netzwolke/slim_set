<?php


namespace App\DB;


use App\DB\Seed\RoleSeed;
use App\DB\Seed\UserSeed;

class Seeder
{
    public function run()
    {
        foreach ($this->loadSeeds() as $seed)
        {
            $default = call_user_func([$seed,'default']);
            call_user_func([$seed,'run'],$default);
        }
    }
    public function loadSeeds() : array
    {
        return [
            RoleSeed::class,
            UserSeed::class
        ];
    }
}