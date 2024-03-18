<?php

namespace Mubasharkk\Oxid\Config\From;

use Mubasharkk\Oxid\Config\ExchangeRatesConfig;
use Mubasharkk\Oxid\Config\ExchangeRatesTrait;

class JsonExchangeRates implements ExchangeRatesConfig
{

    use ExchangeRatesTrait;

    public function __construct(string $filename)
    {
        $data = json_decode(file_get_contents($filename), true);
        $this->baseCurrency = $data['baseCurrency'];
        $this->exchangeRates = $data['exchangeRates'];
    }
}