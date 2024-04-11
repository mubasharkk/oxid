<?php

namespace Mubasharkk\Oxid\Services\Api;

class Response
{
    public function __construct(private array $data, private array $errors = [])
    {
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
