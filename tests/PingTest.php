<?php

namespace Ticketbutler\Tests;

use GuzzleHttp\Psr7\Response;

final class PingTest extends TestCase
{
    public function testPing(): void
    {
        $this->httpResponses = [
            new Response(200),
        ];

        $this->assertTrue($this->ticketbutler()->ping());
    }
}
