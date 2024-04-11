<?php

use Mubasharkk\Oxid\Config\ExchangeRatesConfigFactory;
use Mubasharkk\Oxid\Config\From;
use Mubasharkk\Oxid\Services\Api\FreeCurrencyApiService;
use Mubasharkk\Oxid\Services\Api\Response;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(From\JsonExchangeRates::class)]
#[CoversClass(ExchangeRatesConfigFactory::class)]
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
        // Would have added a mock API but skipped not to keep the testing simple.
        $config = ExchangeRatesConfigFactory::getFromApi(
            new FreeCurrencyApiService('TRY')
        );

        $this->assertEquals($config->getBaseCurrency(), 'TRY');
    }

    public function testMockApiConfig()
    {
        $currencies = [
            'EUR' => 1,
            'USD' => 1.04,
            'CHF' => 0.97,
            'TRY' => 10.53,
        ];

        $mockApi = $this->getMockBuilder(FreeCurrencyApiService::class)
            ->onlyMethods(['getResponse'])
            ->setConstructorArgs([
                'baseCurrency'        => 'EUR',
                'availableCurrencies' => array_keys($currencies),
            ])
            ->getMock();

        $mockApi
            ->expects($this->once())
            ->method('getResponse')
            ->willReturn(new Response($currencies));

        $config = ExchangeRatesConfigFactory::getFromApi($mockApi);

        $this->assertEquals('EUR', $config->getBaseCurrency());
        $this->assertEquals(
            array_keys($currencies),
            $config->getAvailableCurrencies()
        );
    }
}