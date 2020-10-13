<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ExchangeService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getEuro(): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.exchangeratesapi.io/latest?base=USD'
        );
        $content = $response->getContent();
        $content = $response->toArray();

        return $content;
    }
}