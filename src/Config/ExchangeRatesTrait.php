<?php

namespace Mubasharkk\Oxid\Config;

trait ExchangeRatesTrait
{

    private string $baseCurrency;

    private array $exchangeRates;

    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    public function getExchangeRate(string $currency): float
    {
        $exchangeRate = $this->exchangeRates[$currency] ?? null;
        if (!$exchangeRate) {
            // An error is thrown to stop the execution of the application
            // when a requested currency is not available for conversion
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