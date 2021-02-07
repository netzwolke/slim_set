<?php


namespace App\DB;


class DatabaseInterface
{
    public const ENV_STG = '__staging__';
    public const ENV_PROD = '__production__';
    public const DB_STG = 'staging_schema';
    public const DB_PROD = 'productive_schema';
}