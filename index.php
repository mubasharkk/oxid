<?php

use Mubasharkk\Oxid\Config\JsonExchangeRatesConfig;
use Mubasharkk\Oxid\Helpers\ColorizeCLI;
use Mubasharkk\Oxid\Services\CurrencyConverter;

require_once './vendor/autoload.php';


try {

    $config = new JsonExchangeRatesConfig(__DIR__. '/exchange-rates-config.json');
    $currencyConverter = new CurrencyConverter($config);

    $result = $currencyConverter->convertToAllCurrencies('BTC', 1);
    ColorizeCli::success(json_encode($result, JSON_PRETTY_PRINT));

} catch (\Exception $ex) {
    ColorizeCLI::warning($ex->getMessage());
} catch (\Error $err) {
    ColorizeCLI::error($err->getMessage());
}
