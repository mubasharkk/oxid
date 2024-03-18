<?php

namespace Mubasharkk\Oxid\Config;

use PhpParser\Error;
use PHPUnit\Logging\Exception;

class ApiExchangeRatesConfig implements ExchangeRatesConfig
{

    use ExchangeRatesTrait;

    private const API_URI = 'https://api.freecurrencyapi.com/v1/latest';

    public function __construct(private string $baseCurrency = 'EUR')
    {
        $ch = curl_init();

        $uri = self::API_URI.'?'.http_build_query([
                'apikey'        => 'fca_live_ZmNzHcPZjTPadMBc2SBpA1u8zbbytIAiK0mczbI9',
                //'currencies'    => ['EUR', 'USD', 'CHF', 'TRY', 'PHP'],
                'base_currency' => $this->baseCurrency,
            ]);

        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if ($response['errors']) {
            foreach ($response['errors'] as $error) {
                throw new Exception($error[0]);
            }
        }

        $this->exchangeRates = $response['data'];
    }
}