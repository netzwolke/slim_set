<?php


namespace App\DB;


interface MigrationInterface
{
    public function up():void;
    public function down():void;
}