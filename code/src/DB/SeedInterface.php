<?php


namespace App\DB;


interface SeedInterface
{
    public function run(array $seeds) : void;
    public function default() : array;
}