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
                    'User-Agent' => 'TickerbutlerPHP (https://github.com/kasperhartwich/ticketbutler)',
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
        return $this->request('events/');
    }

    public function getEvent($eventUuid): object
    {
        return $this->request('events/'.$eventUuid.'/');
    }

    /** Ticket types */
    public function getEventTicketTypes($eventUuid): array
    {
        return $this->request('events/'.$eventUuid.'/ticket-types/');
    }

    /** Data Collection */
    public function getTicketTypeQuestions($eventUuid): array
    {
        return $this->request('events/'.$eventUuid.'/ticket-type-questions/');
    }

    public function getPurchaseQuestions($eventUuid): object
    {
        return $this->request('events/'.$eventUuid.'/purchase-questions/');
    }

    public function getSpecificQuestion($eventUuid, $questionUuid): object
    {
        return $this->request('events/'.$eventUuid.'/questions/'.$questionUuid.'/');
    }

    /** Orders */
    public function getEventOrders($eventUuid): object
    {
        return $this->request('events/'.$eventUuid.'/orders/');
    }

    public function getCollectedDataFromOrder($orderUuid): object
    {
        return $this->request('orders/'.str_replace('-', '', $orderUuid).'/questions/');
    }

    /** Event Discount codes */
    public function getEventDiscountCodes($eventUuid): object
    {
        return $this->request('events/'.$eventUuid.'/discount-codes/');
    }

    public function createEventDiscountCode($eventUuid, $data): object
    {
        return $this->request('events/'.str_replace('-', '', $eventUuid).'/discount-code/', 'POST', 'json', [
            RequestOptions::JSON => $data,
        ]);
    }

    public function toggleEventDiscountCode($eventUuid, $discountCodeId): object
    {
        return $this->request('events/'.str_replace('-', '', $eventUuid).'/discount-code/'.$discountCodeId.'/');
    }

    public function deleteEventDiscountCode($eventUuid, $codeUuid): object
    {
        return $this->request('events/'.str_replace('-', '', $eventUuid).'/discount-code/'.$codeUuid.'/');
    }

    /** Generic Discount codes */
    public function getGenericDiscountCodes($eventUuid): array
    {
        return $this->request('discount-codes/');
    }

    /** Tickets */
    public function getTickets($uuid): array
    {
        return $this->request('events/'.$uuid.'/tickets/');
    }

    /** Platform Data Exporting */
    public function getAllNewsletterSignups($format = 'json'): array|bool
    {
        switch ($format) {
            case 'json':
                return $this->request('whitelabel/newsletters/?format='.$format);
            case 'xlsx':
                $html = $this->request(
                    'whitelabel/newsletters/?format='.$format,
                    'GET',
                    'html',
                    [
                        RequestOptions::HEADERS => [
                            'Accept' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ],
                    ],
                );

                return (bool) str_contains($html, 'Email with newsletter data will be sent to');
            default:
                throw new \InvalidArgumentException('Invalid format. Only xlsx and json are supported.');
        }
    }

    public function getGetOrdersByMonth(?int $year = null, ?int $month = null, ?string $email = null): bool
    {
        $response = $this->request(
            'whitelabel/orders/?'.http_build_query(array_filter([
                'year' => $year,
                'month' => $month,
                'email' => $email,
            ])),
            'GET',
            'raw',
        );

        return $response->getStatusCode() === 200;
    }

    protected function request($url, $method = 'GET', string $format = 'json', array $options = [])
    {
        $response = $this->client->request($method, $url, $options);
        switch ($format) {
            case 'json':
                return json_decode($response->getBody()->getContents());
            case 'html':
                return $response->getBody()->getContents();
            case 'raw':
            default:
                return $response;
        }
    }
}
