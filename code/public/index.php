<?php

use App\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = new AppFactory();
$app->create();
$app->run();