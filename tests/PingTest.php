<?php

namespace Ticketbutler\Tests;

use GuzzleHttp\Psr7\Response;

final class PingTest extends TestCase
{
    public function test_ping(): void
    {
        $this->httpResponses = [
            new Response(200),
        ];

        $this->assertTrue($this->ticketbutler()->ping());
        $this->assertRequest('GET', 'ping/');
    }

    public function test_a_request_without_a_queued_response_never_reaches_the_api(): void
    {
        $this->expectException(\OutOfBoundsException::class);

        $this->ticketbutler()->ping();
    }
}
