<?php

namespace Ticketbutler\Tests;

use GuzzleHttp\Psr7\Response;

final class TicketsTest extends TestCase
{
    public function test_get_tickets(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '[{"email":"test@testesen.dk","full_name":"Test Testesen","id":1234567,"ticket_refund":true,"uuid":"8d47755c-60ec-4116-9c16-5eccbc678665","ticket_type_name":"Party Ticket","anonymised":false,"attribute":null,"seat":null,"checked_in":false},{"email":"johndoe@example.org","full_name":"John Doe","id":7654321,"ticket_refund":false,"uuid":"a29c6ae7-8250-4436-852e-2540fff9f6e4","ticket_type_name":"Floor Ticket","anonymised":false,"attribute":null,"seat":null,"checked_in":false}]'),
        ];

        $tickets = $this->ticketbutler()->getTickets('85c5effef5864bedb1ae0ac9d7a35bcd');
        $this->assertSame('Test Testesen', $tickets[0]['full_name']);
        $this->assertSame('8d47755c-60ec-4116-9c16-5eccbc678665', $tickets[0]['uuid']);
        $this->assertSame('test@testesen.dk', $tickets[0]['email']);
        $this->assertSame('Party Ticket', $tickets[0]['ticket_type_name']);
    }
}
