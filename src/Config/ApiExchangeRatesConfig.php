<?php

namespace Mubasharkk\Oxid\Config;

class ApiExchangeRatesConfig implements ExchangeRatesConfig
{

    use ExchangeRatesTrait;

    private const API_URI = 'https://api.freecurrencyapi.com/v1/latest';

    private const API_KEY = 'fca_live_ZmNzHcPZjTPadMBc2SBpA1u8zbbytIAiK0mczbI9';

    public function __construct(private string $baseCurrency = 'EUR')
    {
        $response = $this->getDataFromApi();

        if ($response['errors']) {
            foreach ($response['errors'] as $error) {
                throw new \Error($error[0]);
            }
        }

        $this->exchangeRates = $response['data'];
    }

    private function getDataFromApi(array $availableCurrencies = []): array
    {
        $ch = curl_init();

        $uri = self::API_URI.'?'.http_build_query([
                'apikey'        => self::API_KEY,
                'currencies'    => $availableCurrencies, //['EUR', 'USD', 'CHF', 'TRY', 'PHP']
                'base_currency' => $this->baseCurrency,
            ]);

        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $response;
    }
}