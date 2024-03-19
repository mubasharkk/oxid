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
        $ch = curl_init();

        $uri = self::API_URI.'?'.http_build_query([
                'apikey'        => self::API_KEY,
                //['EUR', 'USD', 'CHF', 'TRY', 'PHP']
                'currencies'    => array_merge(
                    [$this->baseCurrency],
                    $this->availableCurrencies
                ),
                'base_currency' => $this->baseCurrency,
            ]);

        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

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