<?php

namespace Mubasharkk\Oxid\Config;

class JsonExchangeRatesConfig implements ExchangeRatesConfig
{
    use ExchangeRatesTrait;

    public function __construct(string $filename)
    {
        $data = json_decode(file_get_contents($filename), true);
        $this->baseCurrency = $data['baseCurrency'];
        $this->exchangeRates = $data['exchangeRates'];
    }
}