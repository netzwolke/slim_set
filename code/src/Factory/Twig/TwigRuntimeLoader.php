<?php


namespace App\Factory\Twig;

use App\Resources\Logger;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

class TwigRuntimeLoader implements RuntimeLoaderInterface
{
    /**
     * @var Logger
     */
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function load(string $class)
    {
        if (TwigFunctions::class === $class) {
            return new $class($this->logger);
        }
    }
}
