<?php

namespace Mubasharkk\Oxid\Config\From;

use Mubasharkk\Oxid\Config\ExchangeRatesConfig;
use Mubasharkk\Oxid\Config\ExchangeRatesTrait;

class CsvExchangeRates implements ExchangeRatesConfig
{
    use ExchangeRatesTrait;

    public function __construct(/*string $filename*/)
    {
        //@todo: Write your code for csv config file parsing here
    }
}
