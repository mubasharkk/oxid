<?php

namespace Mubasharkk\Oxid\Config\From;

use Mubasharkk\Oxid\Config\ExchangeRatesConfig;
use Mubasharkk\Oxid\Config\ExchangeRatesTrait;

class XmlExchangeRates implements ExchangeRatesConfig
{
    use ExchangeRatesTrait;

    public function __construct(string $filename)
    {
        //@todo: Do you csv config file parsing here accordingly
    }
}