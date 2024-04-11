<?php

namespace Mubasharkk\Oxid\Renderers;

class CsvRenderer implements OutputRenderer
{
    public function __construct(
        private array $results,
        private array $headings = [],
        private string $separator = ',',
    ) {
    }

    public function generate(): string
    {
        $fileStream = fopen('php://memory', 'r+');

        if ($this->headings) {
            fputcsv($fileStream, $this->headings, $this->separator);
        }

        foreach ($this->results as $currency => $amount) {
            fputcsv($fileStream, [$currency, $amount], $this->separator);
        }
        rewind($fileStream);

        return stream_get_contents($fileStream);
    }
}
