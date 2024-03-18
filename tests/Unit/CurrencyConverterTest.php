<?php

use Mubasharkk\Oxid\Config\JsonExchangeRatesConfig;
use Mubasharkk\Oxid\Services\CurrencyConverter;

class CurrencyConverterTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \Mubasharkk\Oxid\Services\CurrencyConverter
     */
    private CurrencyConverter $currencyConverter;

    public function setUp(): void
    {
        $config = new JsonExchangeRatesConfig(
            __DIR__.'/../test-exchange-rates-config.json'
        );

        $this->currencyConverter = new CurrencyConverter($config);;
    }

    public function testCurrenciesConversionToEur()
    {
        $this->assertEquals(
            $this->currencyConverter->convertToBaseCurrency('CHF', 100),
            103.09
        );

        $this->assertEquals(
            $this->currencyConverter->convertToBaseCurrency('PKR', 600),
            1.97
        );

        $this->assertEquals(
            $this->currencyConverter->convertToBaseCurrency('USD', 500),
            458.93
        );

        $this->assertEquals(
            $this->currencyConverter->convertToBaseCurrency('CNY', 23),
            2.93
        );

        $this->assertEquals(
            $this->currencyConverter->convertToBaseCurrency('BTC', 1),
            62500
        );
    }

    public function testUnavailableCurrencies()
    {
        $this->expectExceptionMessage(
            "The requested currency 'PESO' exchange rate is currently not available."
        );

        $this->currencyConverter->convertToBaseCurrency('PESO', 500);
    }


}