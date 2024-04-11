<?php

namespace Mubasharkk\Oxid\Renderers;

class JsonRenderer implements OutputRenderer
{
    public function __construct(private array $results)
    {
    }

    public function generate(): string
    {
        return \json_encode($this->results, JSON_PRETTY_PRINT);
    }
}
