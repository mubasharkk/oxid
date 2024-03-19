<?php

namespace Mubasharkk\Oxid\Renderer;

class OutputRenderer implements JsonRenderer, CsvRenderer
{

    public function __construct(private array $results = [])
    {
    }

    public function add(string $currency, float $amount): void
    {
        $this->results[$currency] = $amount;
    }

    public function get(string $currency): float
    {
        return $this->results[$currency];
    }


    public function toJson(int $flags = 0): string
    {
        return \json_encode($this->results, $flags);
    }

    public function toCsv(
        array $headings = [],
        string $delimiter = ',',
        string $enclosure = '"',
        string $escape_char = "\\"
    ): string {
        return $this->array2csv($headings, $delimiter, $enclosure,
            $escape_char);
    }

    private function array2csv(
        array $headings = [],
        string $delimiter = ',',
        string $enclosure = '"',
        string $escape_char = "\\"
    ) {
        $f = fopen('php://memory', 'r+');

        if ($headings) {
            fputcsv($f, $headings, $delimiter, $enclosure, $escape_char);
        }

        foreach ($this->results as $currency => $amount) {
            fputcsv($f, [$currency, $amount], $delimiter, $enclosure,
                $escape_char);
        }
        rewind($f);

        return stream_get_contents($f);
    }

    public function __toString(): string
    {
        return $this->toJson();
    }
}