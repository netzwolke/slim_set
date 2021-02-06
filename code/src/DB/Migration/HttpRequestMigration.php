<?php


namespace App\DB\Migration;


use App\DB\MigrationInterface;
use Illuminate\Database\Capsule\Manager;

class HttpRequestMigration implements MigrationInterface
{

    /**
     *
     */
    public function up(): void
    {
        Manager::schema()->create('httpRequests', function($table){
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->string('uri');
            $table->json('options');
            $table->integer('workerId')->nullable();
            $table->timestamps();
        });

    }

    /**
     *
     */
    public function down(): void
    {
        Manager::schema()->dropIfExists('httpRequests');
    }
}