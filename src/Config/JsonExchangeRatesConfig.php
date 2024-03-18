<?php

namespace Mubasharkk\Oxid\Config;

class JsonExchangeRatesConfig implements ExchangeRatesConfig
{

    private string $baseCurrency;

    private array $exchangeRates;

    public function __construct(string $filename)
    {
        $data = json_decode(file_get_contents($filename), true);
        $this->baseCurrency = $data['baseCurrency'];
        $this->exchangeRates = $data['exchangeRates'];
    }

    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    public function getExchangeRate(string $currency): float
    {
        $exchangeRate = $this->exchangeRates[$currency] ?? null;
        if (!$exchangeRate) {
            throw new \Error(
                "The requested currency '{$currency}' exchange rate is currently not available."
            );
        }

        return $exchangeRate;
    }

    public function getAvailableCurrencies(): array
    {
        return array_keys($this->exchangeRates);
    }
}