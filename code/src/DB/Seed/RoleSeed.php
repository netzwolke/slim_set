<?php


namespace App\DB\Seed;


use App\DB\SeedInterface;
use App\Model\Role;

class RoleSeed implements SeedInterface
{

    public function run(array $seeds): void
    {
        foreach($seeds as $seed){
            Role::create($seed);
        }
    }

    public function default(): array
    {
        return [
            [
                'name'=>'Admin',
                'power'=> 10000,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),

            ], [
                'name'=>'User',
                'power'=> 1000,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ], [
                'name'=>'Guest',
                'power'=> 0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]
        ];
    }
}