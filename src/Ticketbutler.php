<?php

namespace Ticketbutler;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client;

/**
 * Class Ticketbutler
 * Documentation: https://lab.ticketbutler.io/
 */
class Ticketbutler
{
    protected $client;

    public function __construct(string $token, string $domain, $client = null)
    {
        if (!$client) {
            $client = new Client([
                'base_uri' => 'https://' . $domain . '/api/v3/',
                RequestOptions::HEADERS => [
                    'Authorization' => 'Token ' . $token,
                    'User-Agent' => 'Tickerbutler/1.0.0 (https://github.com/kasperhartwich/ticketbutler)',
                    'Content-Type' => 'application/json; charset=utf-8',
                    'Accept' => 'application/json',
                ],
            ]);
        }
        $this->client = $client;
    }

    public function ping()
    {
        return ($this->client->get('ping/'))->getStatusCode() === 200;
    }

    public function events()
    {
        $response = $this->client->get('events/');
        return json_decode($response->getBody()->getContents(), true);
    }

    public function tickets($uuid)
    {
        $response = $this->client->get('events/' . $uuid . '/tickets/');
        return json_decode($response->getBody()->getContents(), true);
    }

}
