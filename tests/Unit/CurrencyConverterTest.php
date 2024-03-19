<?php

use Mubasharkk\Oxid\Config\From;
use Mubasharkk\Oxid\Services\CurrencyConverter;

class CurrencyConverterTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \Mubasharkk\Oxid\Services\CurrencyConverter
     */
    private CurrencyConverter $currencyConverter;

    public function setUp(): void
    {
        $config = new From\JsonExchangeRates(
            __DIR__.'/../test-exchange-rates-config.json'
        );

        $this->currencyConverter = new CurrencyConverter($config);;
    }

    public function testCurrenciesConversionToEur()
    {
        $this->assertEquals(
            103.09,
            $this->currencyConverter->convertToBaseCurrency('CHF', 100),
        );

        $this->assertEquals(
            1.97,
            $this->currencyConverter->convertToBaseCurrency('PKR', 600),
        );

        $this->assertEquals(
            458.93,
            $this->currencyConverter->convertToBaseCurrency('USD', 500),
        );

        $this->assertEquals(
            2.93,
            $this->currencyConverter->convertToBaseCurrency('CNY', 23),
        );

        $this->assertEquals(
            62500,
            $this->currencyConverter->convertToBaseCurrency('BTC', 1),
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