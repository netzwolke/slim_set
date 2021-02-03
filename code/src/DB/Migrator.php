<?php


namespace App\DB;


use App\DB\Migration\RoleMigration;
use App\DB\Migration\UserMigration;

class Migrator
{
    public function run()
    {
        foreach($this->migrations() as $migration)
        {
            call_user_func([$migration, 'up']);
        }
    }
    public function migrations()
    {
        return [
            RoleMigration::class,
            UserMigration::class

        ];
    }
}