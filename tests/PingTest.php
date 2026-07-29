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
    }
}
