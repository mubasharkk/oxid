<?php

namespace Mubasharkk\Oxid\Config\From;

use Mubasharkk\Oxid\Config\ExchangeRatesConfig;
use Mubasharkk\Oxid\Config\ExchangeRatesTrait;
use Mubasharkk\Oxid\Services\Api\ExchangeRatesApiService;

class ApiExchangeRates implements ExchangeRatesConfig
{

    use ExchangeRatesTrait;

    public function __construct(ExchangeRatesApiService $api)
    {
        $this->baseCurrency = $api->getBaseCurrency();

        $response = $api->getResponse();

        if ($response->hasErrors()) {
            foreach ($response->getErrors() as $error) {
                throw new \Error($error[0]);
            }
        }
        $this->exchangeRates = $response->getData();
    }

}