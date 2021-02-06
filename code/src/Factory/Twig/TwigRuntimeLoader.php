<?php


namespace App\Factory\Twig;

use App\Resources\Output\Messenger;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

class TwigRuntimeLoader implements RuntimeLoaderInterface
{

    /**
     * @var Messenger
     */



    /**
     * @inheritDoc
     */
    public function load(string $class)
    {
        if (TwigFunctions::class === $class) {
            return new $class();
        }
    }
}
