<?php


namespace App\Resources;


use App\Model\Config;

class Seeder
{
    public function __construct()
    {

    }

    public function isNeeded()
    {
        if(! Config::all()->isEmpty())
        {
            return 0;
        }
        return 1;
    }
}