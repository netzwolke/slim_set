<?php


namespace App\DB\Migration;


use App\DB\MigrationInterface;
use Illuminate\Database\Capsule\Manager;

class RoleMigration implements MigrationInterface
{

    /**
     *
     */
    public function up(): void
    {
        Manager::schema()->create('roles', function($table){
           $table->increments('id');
           $table->string('name');
           $table->integer('power');
           $table->timestamps();
        });

    }

    /**
     *
     */
    public function down(): void
    {
        Manager::schema()->dropIfExists('roles');
    }
}