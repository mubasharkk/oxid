<?php

namespace Mubasharkk\Oxid\Config;

interface ExchangeRatesConfig
{
    public function getBaseCurrency(): string;

    public function getExchangeRate(string $currency): float;

    public function getAvailableCurrencies(): array;
}
