<?php

use Mubasharkk\Oxid\Config\From;
use Mubasharkk\Oxid\Config\ExchangeRatesConfigFactory;

class ExchangeRatesConfigTest extends \PHPUnit\Framework\TestCase
{

    private From\JsonExchangeRates $config;

    public function setUp(): void
    {
        $this->config = new From\JsonExchangeRates(
            __DIR__.'/../test-exchange-rates-config.json'
        );
    }

    public function testBaseCurrency()
    {
        $this->assertEquals($this->config->getBaseCurrency(), 'EUR');
    }

    public function testAvailableCurrencies()
    {
        $this->assertContains(
            'CHF',
            $this->config->getAvailableCurrencies()
        );
        $this->assertContains(
            'USD',
            $this->config->getAvailableCurrencies()
        );
    }

    public function testCsvXmlConfig()
    {
        // As we don't have a CSV configurator
        $config = ExchangeRatesConfigFactory::get('test-config.csv');

        // we are only testing if the factory is returning the correct value from match
        $this->assertInstanceOf(From\CsvExchangeRates::class, $config);

        // As we don't have a CSV configurator
        $config = ExchangeRatesConfigFactory::get('test-config.xml');

        // we are only testing if the factory is returning the correct value from match
        $this->assertInstanceOf(From\XmlExchangeRates::class, $config);

    }

    public function testApiConfig()
    {
        $config = ExchangeRatesConfigFactory::getFromApi('TRY');

        $this->assertEquals($config->getBaseCurrency(), 'TRY');

//        $configViaApi = $this->getMockBuilder(ApiExchangeRatesConfig::class)
//            ->onlyMethods(['getDataFromApi']) // Mock only getDataFromApi()
//            ->getMock();
//
//        $configViaApi
//            ->expects($this->once())
//            ->method('getDataFromApi')
//            ->willReturnMap([
//                'data' => [
//                    'EUR' => 1, 'USD' => 1.5, 'PKR' => 300,
//                ],
//            ]);
//
//        $this->assertEquals($configViaApi->getBaseCurrency(), 'EUR');
//        $this->assertEquals($configViaApi->getAvailableCurrencies(), [
//            'EUR',
//            'USD',
//            'PKR',
//        ]);
//
//        $this->assertEquals($configViaApi->getExchangeRate('PKR'), 300);
    }
}