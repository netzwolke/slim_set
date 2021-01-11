<?php
declare(strict_types=1);
namespace App\Resources;


class Logger
{
    private array $errorBag;

    public array $successBag;

    public function __construct(array $err = [], array $succ = [])
    {
        $this->errorBag = $err;
        $this->successBag = $succ;
    }
    /**
    *
    * @return Logger
    */
    public static function create(): self
    {
        return new self();
    }
    public function getErrors(): array
    {
        return $this->errorBag;
    }
    public function getSuccesses(): array
    {
        return $this->successBag;
    }
    public function addError($exception)
    {
        $this->errorBag [] = $exception;
    }

}