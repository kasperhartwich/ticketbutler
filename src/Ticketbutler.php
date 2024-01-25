<?php

namespace Ticketbutler;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Class Ticketbutler
 * Documentation: https://lab.ticketbutler.io/
 */
class Ticketbutler
{
    protected Client $client;

    public function __construct(string $token, string $domain, ?Client $client = null)
    {
        if (! $client) {
            $client = new Client([
                'base_uri' => 'https://'.$domain.'/api/v3/',
                RequestOptions::HEADERS => [
                    'Authorization' => 'Token '.$token,
                    'User-Agent' => 'Tickerbutler/1.0 (https://github.com/kasperhartwich/ticketbutler)',
                    'Content-Type' => 'application/json; charset=utf-8',
                ],
            ]);
        }
        $this->client = $client;
    }

    public function ping(): bool
    {
        return $this->client->get('ping/')->getStatusCode() === 200;
    }

    /** Events */
    public function getEvents(): array
    {
        $response = $this->client->get('events/');

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    public function getEvent($eventUuid): array
    {
        $response = $this->client->get('events/'.$eventUuid.'/');

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    /** Ticket types */
    public function getEventTicketTypes($eventUuid): array
    {
        $response = $this->client->get('events/'.$eventUuid.'/ticket-types/');

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    /** Orders */
    public function getEventOrders($eventUuid): array
    {
        $response = $this->client->get('events/'.$eventUuid.'/orders/');

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    public function getCollectedDataFromOrder($orderUuid): array
    {
        $response = $this->client->get('orders/'.str_replace('-', '', $orderUuid).'/questions/');

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    /** Event Discount codes */
    public function getEventDiscountCodes($eventUuid): array
    {
        $response = $this->client->get('events/'.$eventUuid.'/discount-codes/');

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    /** Generic Discount codes */
    public function getGenericDiscountCodes($eventUuid): array
    {
        $response = $this->client->get('discount-codes/');

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    /** Tickets */
    public function getTickets($uuid): array
    {
        $response = $this->client->get('events/'.$uuid.'/tickets/');

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    /** Platform Data Exporting */
    public function getAllNewsletterSignups($format = 'json'): array|bool
    {
        switch ($format) {
            case 'json':
                $response = $this->client->get('whitelabel/newsletters/?format='.$format);

                return (array) json_decode($response->getBody()->getContents(), true);
            case 'xlsx':
                $response = $this->client->get('whitelabel/newsletters/?format='.$format, [
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                ]);

                return (bool) str_contains($response->getBody()->getContents(), 'Email with newsletter data will be sent to');
            default:
                throw new \InvalidArgumentException('Invalid format. Only xlsx and json are supported.');
        }
    }

    public function getGetOrdersByMonth(?int $year = null, ?int $month = null, ?string $email = null): bool
    {
        $response = $this->client->get('whitelabel/orders/?'.http_build_query(array_filter([
            'year' => $year,
            'month' => $month,
            'email' => $email,
        ])));

        return $response->getStatusCode() === 200;
    }
}
