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
        $this->assertSame('FREETICKET', $eventOrders['results'][0]['code']);
        $this->assertSame('100.00', $eventOrders['results'][0]['amount']);

        $this->assertSame('20OFF', $eventOrders['results'][1]['code']);
        $this->assertSame('397.50', $eventOrders['results'][1]['total_revenue']);
    }
}
