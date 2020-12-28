<?php

use Slim\Views\Twig;
use function DI\factory;

return [
    Twig::class => factory([Twig::class,'create'])->parameter('loader','../src/View')->parameter('settings',['cache'=>false])
];