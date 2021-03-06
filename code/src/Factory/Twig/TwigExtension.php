<?php


namespace App\Factory\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function getFunctions():array
    {
        return [
            new TwigFunction('example', [TwigFunctions::class,'example']),
            new TwigFunction('auth', [TwigFunctions::class,'auth']),
            new TwigFunction('getUser', [TwigFunctions::class,'getUser']),
            new TwigFunction('getMessage',[TwigFunctions::class, 'getMessage']),
            new TwigFunction('hasMessage',[TwigFunctions::class, 'hasMessage']),

        ];
    }
}
