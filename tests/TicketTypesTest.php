<?php

namespace Ticketbutler\Tests;

use GuzzleHttp\Psr7\Response;

final class TicketTypesTest extends TestCase
{
    public function test_get_event_ticket_types(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '[{"uuid":"1dcbc650d655464fbab625371b22c0b6","pk":106359,"title":"Regular Conference Ticket","price":620,"active":true,"amount_left":12,"amount_total":200,"is_members_only":false,"is_free":false,"amount_sold":188,"is_tickets_sold":true,"sold_out":false,"start_date":null,"fee":0,"sort_id":1,"constraint_definition":null,"invoice_price":null,"description":null,"sales_start_date":null,"sales_end_date":"2024-08-01T00:00:00+02:00","is_on_sale":true},{"uuid":"f494b221af154a288dd5a77a8c15d852","pk":108012,"title":"Last Minute Conference Ticket","price":690,"active":true,"amount_left":20,"amount_total":20,"is_members_only":false,"is_free":false,"amount_sold":0,"is_tickets_sold":false,"sold_out":false,"start_date":null,"fee":0,"sort_id":2,"constraint_definition":null,"invoice_price":null,"description":null,"sales_start_date":null,"sales_end_date":null,"is_on_sale":true}]'),
        ];

        $ticketTypes = $this->ticketbutler()->getEventTicketTypes('85c5effef5864bedb1ae0ac9d7a35bcd');
        $this->assertSame('1dcbc650d655464fbab625371b22c0b6', $ticketTypes[0]['uuid']);
        $this->assertSame('Regular Conference Ticket', $ticketTypes[0]['title']);
        $this->assertSame(188, $ticketTypes[0]['amount_sold']);
        $this->assertSame(620, $ticketTypes[0]['price']);
    }
}
