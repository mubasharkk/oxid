<?php

namespace Mubasharkk\Oxid\Config;

class ExchangeRatesConfigFactory
{

    public static function get(string $source): ExchangeRatesConfig
    {
        $extension = pathinfo($source, PATHINFO_EXTENSION);

        return match ($extension) {
            'json' => new JsonExchangeRatesConfig($source),
//            'csv' => null, //@todo: Need to add csv configurator
//            'xml' => null, //@todo: Need to add xml configurator
            default => throw new \Error("Unable to find configuration file: {$source}"),
        };
    }

    public static function getFromApi(string $baseCurrency = 'EUR'): ExchangeRatesConfig
    {
        return new ApiExchangeRatesConfig($baseCurrency);
    }
}