<?php


namespace App\DB\Migration;


use App\DB\MigrationInterface;
use Illuminate\Database\Capsule\Manager;

class UserMigration implements MigrationInterface
{
    /**
     *
     */
    public function up(): void
    {
        Manager::schema()->create('users', function($table){
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->integer('roleId');
            $table->timestamps();
        });

    }

    /**
     *
     */
    public function down(): void
    {
        Manager::schema()->dropIfExists('users');
    }
}