<?php


namespace App\Factory\Twig;

use Twig\RuntimeLoader\RuntimeLoaderInterface;

class TwigRuntimeLoader implements RuntimeLoaderInterface
{

    /**
     * @inheritDoc
     */
    public function load(string $class)
    {
        if (TwigFunctions::class === $class) {
            return new $class;
        }
    }
}
