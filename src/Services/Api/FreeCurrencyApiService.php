<?php

namespace Mubasharkk\Oxid\Services\Api;

class FreeCurrencyApiService implements ExchangeRatesApiService
{
    private const API_URI = 'https://api.freecurrencyapi.com/v1/latest';

    private const API_KEY = 'fca_live_ZmNzHcPZjTPadMBc2SBpA1u8zbbytIAiK0mczbI9';

    public function __construct(
        private string $baseCurrency = 'EUR',
        private array $availableCurrencies = []
    ) {
    }

    public function getResponse(): Response
    {
        $requestObject = curl_init();

        $uri = self::API_URI.'?'.http_build_query([
                'apikey'        => self::API_KEY,
                //['EUR', 'USD', 'CHF', 'TRY', 'PHP']
                'currencies'    => array_merge(
                    [$this->baseCurrency],
                    $this->availableCurrencies
                ),
                'base_currency' => $this->baseCurrency,
            ]);

        curl_setopt($requestObject, CURLOPT_URL, $uri);
        curl_setopt($requestObject, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($requestObject), true);
        curl_close($requestObject);

        return new Response(
            $response['data'] ?? [],
            $response['errors'] ?? []
        );
    }

    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }
}
