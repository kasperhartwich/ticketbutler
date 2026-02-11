<?php

namespace Ticketbutler\Tests;

use GuzzleHttp\Psr7\Response;

final class DiscountCodesTest extends TestCase
{
    public function test_get_event_discount_codes(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"count":2,"next":null,"previous":null,"results":[{"id":50333,"applies_to":{"applied_to_ticket":0,"applied_to_event":0},"active":true,"group_uuid":null,"group_name":null,"amount":"100.00","code":"FREETICKET","toggle_url":"/api/event/85c5effef5864bedb1ae0ac9d7a35bcd/discount-code/50333/","usage_tickets_limit":4,"usage_limit_per_event":null,"amount_tickets_applied":4,"discount_type":"PERCENTAGE","total_revenue":"0.00","start_date":"2024-01-05T15:07:03.435463Z","end_date":null},{"id":51111,"applies_to":{"applied_to_ticket":0,"applied_to_event":0},"active":false,"group_uuid":null,"group_name":null,"amount":"20.00","code":"20OFF","toggle_url":"/api/event/85c5effef5864bedb1ae0ac9d7a35bcd/discount-code/51111/","usage_tickets_limit":20,"usage_limit_per_event":null,"amount_tickets_applied":1,"discount_type":"PERCENTAGE","total_revenue":"397.50","start_date":"2024-01-11T18:21:43.668651Z","end_date":null}]}'),
        ];

        $eventOrders = $this->ticketbutler()->getEventDiscountCodes('85c5effef5864bedb1ae0ac9d7a35bcd');
        $this->assertSame('FREETICKET', $eventOrders->results[0]->code);
        $this->assertSame('100.00', $eventOrders->results[0]->amount);

        $this->assertSame('20OFF', $eventOrders->results[1]->code);
        $this->assertSame('397.50', $eventOrders->results[1]->total_revenue);
    }

    public function test_create_event_discount_code(): void
    {
        $this->httpResponses = [
            new Response(
                201,
                ['Content-Type' => 'application/json'],
                '{"id":50334,"active":true,"amount":"50.00","code":"HALFOFF","discount_type":"PERCENTAGE","usage_tickets_limit":10,"usage_limit_per_event":null}'
            ),
        ];

        $result = $this->ticketbutler()->createEventDiscountCode('85c5effe-f586-4bed-b1ae-0ac9d7a35bcd', [
            'code' => 'HALFOFF',
            'amount' => '50.00',
            'discount_type' => 'PERCENTAGE',
            'usage_tickets_limit' => 10,
        ]);

        $this->assertSame(50334, $result->id);
        $this->assertSame('HALFOFF', $result->code);
        $this->assertSame('50.00', $result->amount);
        $this->assertSame('PERCENTAGE', $result->discount_type);
    }

    public function test_toggle_event_discount_code(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"id":50333,"active":false,"code":"FREETICKET","amount":"100.00","discount_type":"PERCENTAGE"}'
            ),
        ];

        $result = $this->ticketbutler()->toggleEventDiscountCode('85c5effe-f586-4bed-b1ae-0ac9d7a35bcd', 50333);

        $this->assertSame(50333, $result->id);
        $this->assertFalse($result->active);
    }

    public function test_delete_event_discount_code(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"id":50333,"deleted":true}'
            ),
        ];

        $result = $this->ticketbutler()->deleteEventDiscountCode('85c5effe-f586-4bed-b1ae-0ac9d7a35bcd', '50333');

        $this->assertSame(50333, $result->id);
    }
}
