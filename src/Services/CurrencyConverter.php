<?php

namespace Mubasharkk\Oxid\Services;

use Mubasharkk\Oxid\Config\ExchangeRatesConfig;

class CurrencyConverter
{

    public function __construct(private ExchangeRatesConfig $ratesConfig)
    {
    }

    private function getExchangeRateFromBaseCurrency(string $currency): float
    {
        $exchangeRate = $this->ratesConfig->getExchangeRate($currency);
        $baseCurrencyExchangeRate = $this->ratesConfig->getExchangeRate(
            $this->ratesConfig->getBaseCurrency()
        );

        return $exchangeRate / $baseCurrencyExchangeRate;
    }

    public function convertToBaseCurrency(string $currencyType, float $amountToConvert): float
    {
        $baseConversionRate = $this->getExchangeRateFromBaseCurrency(
            $currencyType
        );

        return round($amountToConvert / $baseConversionRate, 2);
    }

    public function convertToCurrencies(string $currencyType, float $amount)
    {
        $amountInBaseCurrency = $this->convertToBaseCurrency(
            $currencyType,
            $amount
        );

        $result = [];
        $currencies = $this->ratesConfig->getAvailableCurrencies();
        foreach ($currencies as $cur) {
            $result[$cur] = round($amountInBaseCurrency * $this->ratesConfig->getExchangeRate($cur), 2);
        }

        return $result;
    }

    public function getConfig(): ExchangeRatesConfig
    {
        return $this->ratesConfig;
    }
}