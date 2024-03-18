<?php

namespace Mubasharkk\Oxid\Config;

use Mubasharkk\Oxid\Config\From;

class ExchangeRatesConfigFactory
{

    public static function get(string $source): ?ExchangeRatesConfig
    {
        $extension = pathinfo($source, PATHINFO_EXTENSION);

        /**
         * ALTERNATIVELY: we can move the logic for file and config parsing here
         * and create & return a unified config class
         * ExchangeRateConfig(
         *      string $baseCurrency = 'EUR',
         *      array $exchangeRates = ['USD' => 1.5, 'EUR' => 1, 'CHF' => 0.96
         * )
         * This will remove the `ExchangeRatesTrait`
         * and probably there won't be a need for DI `ExchangeRatesConfig` as the
         * factory will always return 1 type of object
         *
         * BUT then Factory is doing a lot more what it should basically do and
         * violates the Single Responsibility principle and in future if we have
         * to add more sources the complexity of the factory will increase.
         */

        return match ($extension) {
            'json' => new From\JsonExchangeRates($source),
            'csv' => new From\CsvExchangeRates($source),
            'xml' => new From\XmlExchangeRates($source),
            default => throw new \Error("Unable to find configuration file: {$source}"),
        };
    }

    public static function getFromApi(
        string $baseCurrency = 'EUR'
    ): ExchangeRatesConfig {
        /**
         * Here we have the advantage we can add multiple API sources here
         * when needed later, as pattern as above for file sources.
         */
        return new From\ApiExchangeRates($baseCurrency);
    }
}