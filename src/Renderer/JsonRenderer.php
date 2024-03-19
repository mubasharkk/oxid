<?php

namespace Mubasharkk\Oxid\Renderer;

interface JsonRenderer
{

    public function toJson(int $flags = 0): string;
}