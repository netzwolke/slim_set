<?php
declare(strict_types=1);

namespace App\Resources\Output;


class Message implements OutputMessageInterface
{

    private array $Messages;

    public function __construct($errors = [], $warnings = [], $successes = [])
    {
        $this->Messages = [
            self::Error => $errors,
            self::Warning => $warnings,
            self::Success => $successes
        ];
    }

    public  function add($type, $message)
    {
        $this->Messages[$type] [] =  $message;
    }
    public function get($type): array
    {
        return $this->Messages[$type];
    }
    public function clear($type)
    {
        unset($this->Messages[$type]);
        $this->Messages[$type] = [];
    }


}