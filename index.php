<?php

use Mubasharkk\Oxid\Config\ExchangeRatesConfigFactory;
use Mubasharkk\Oxid\Helpers\ColorizeCLI;
use Mubasharkk\Oxid\Renderers;
use Mubasharkk\Oxid\Services\Api\FreeCurrencyApiService;
use Mubasharkk\Oxid\Services\CurrencyConverter;

require_once './vendor/autoload.php';

try {
    // load config from a file
    $config = ExchangeRatesConfigFactory::get(
        __DIR__.'/exchange-rates-config.json'
    );

    // load config from external API https://app.freecurrencyapi.com
    // enable this to calculate results from realtime exchange rates
    $config = ExchangeRatesConfigFactory::getFromApi(
        new FreeCurrencyApiService('TRY', ['EUR', 'USD'])
    );

    $currencyConverter = new CurrencyConverter($config);

    $result = $currencyConverter->convertToCurrencies('USD', 100);

  // Print as json string
    ColorizeCLI::info(ColorizeCLI::textBold('Printing as JSON'));
    ColorizeCli::success(
        (new Renderers\JsonRenderer($result))->generate()
    );

    // print as csv string
    ColorizeCLI::info(ColorizeCLI::textBold('Printing as CSV'));
    ColorizeCli::success(
        (new Renderers\CsvRenderer($result, ['CURRENCY', 'AMOUNT']))->generate()
    );

} catch (\Exception $ex) {
    ColorizeCLI::warning($ex->getMessage());
} catch (\Error $err) {
    ColorizeCLI::error($err->getMessage());
}
