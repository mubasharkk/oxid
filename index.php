<?php

use Mubasharkk\Oxid\Config\ExchangeRatesConfigFactory;
use Mubasharkk\Oxid\Helpers\ColorizeCLI;
use Mubasharkk\Oxid\Renderer;
use Mubasharkk\Oxid\Services\CurrencyConverter;

require_once './vendor/autoload.php';

try {
    // load config from a file
    $config = ExchangeRatesConfigFactory::get(
        __DIR__.'/exchange-rates-config.json'
    );

    // load config from external API https://app.freecurrencyapi.com
    // enable this to calculate results from realtime exchange rates
    $config = ExchangeRatesConfigFactory::getFromApi('TRY');

    $currencyConverter = new CurrencyConverter($config);

    $result = $currencyConverter->convertToCurrencies('USD', 34000);

    /*
     * Reason to not couple it with `CurrencyConvert` is that here we are
     * flexible to chose however we want print/display the results.
     * Additional, we can use the `OutputRenderer` to print other type of data
     */
    $renderer = new Renderer\OutputRenderer($result);

    // Print as json string
    ColorizeCLI::info(ColorizeCLI::textBold('Printing as JSON'));
    ColorizeCli::success($renderer->toJson(JSON_PRETTY_PRINT));

    // print as csv string
    ColorizeCLI::info(ColorizeCLI::textBold('Printing as CSV'));
    ColorizeCli::success($renderer->toCsv(
        ['CURRENCY', 'AMOUNT']
    ));

    // print as string, default format is json
    ColorizeCLI::info(ColorizeCLI::textBold('Printing as String'));
    ColorizeCli::success($renderer);

} catch (\Exception $ex) {
    ColorizeCLI::warning($ex->getMessage());
} catch (\Error $err) {
    ColorizeCLI::error($err->getMessage());
}
