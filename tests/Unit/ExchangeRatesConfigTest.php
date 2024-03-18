<?php

use Mubasharkk\Oxid\Config\JsonExchangeRatesConfig;

class ExchangeRatesConfigTest extends \PHPUnit\Framework\TestCase
{
    private JsonExchangeRatesConfig $config;

    public function setUp(): void
    {
        $this->config = new JsonExchangeRatesConfig(
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
}