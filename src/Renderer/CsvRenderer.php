<?php

namespace Mubasharkk\Oxid\Renderer;

interface CsvRenderer
{

    public function toCsv(
        array $headings = [],
        string $delimiter = ',',
        string $enclosure = '"',
        string $escape_char = "\\"
    ): string;
}