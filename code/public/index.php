<?php


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = new AppFactory();
$app->create();


$app->run();