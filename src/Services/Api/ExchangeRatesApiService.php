<?php

namespace Mubasharkk\Oxid\Services\Api;

interface ExchangeRatesApiService
{
    public function getBaseCurrency(): string;

    public function getResponse(): Response;
}
