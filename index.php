<?php

use Mubasharkk\Oxid\Config\ExchangeRatesConfigFactory;
use Mubasharkk\Oxid\Helpers\ColorizeCLI;
use Mubasharkk\Oxid\Services\CurrencyConverter;

require_once './vendor/autoload.php';

try {

    // load config from a file
    $config = ExchangeRatesConfigFactory::get(__DIR__. '/exchange-rates-config.json');
    // load config from API https://app.freecurrencyapi.com
    $config = ExchangeRatesConfigFactory::getFromApi('EUR');

    $currencyConverter = new CurrencyConverter($config);

    $result = $currencyConverter->convertToAllCurrencies('USD', 532);
    ColorizeCli::success(json_encode($result, JSON_PRETTY_PRINT));

} catch (\Exception $ex) {
    ColorizeCLI::warning($ex->getMessage());
} catch (\Error $err) {
    ColorizeCLI::error($err->getMessage());
}
