<?php

namespace Ticketbutler\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Ticketbutler\Ticketbutler;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var Ticketbutler */
    protected $ticketbutler;

    /** @var array */
    protected $httpResponses = [];

    /** @var array */
    protected $httpHistory = [];

    /**
     * Always backed by a MockHandler: a test without queued responses fails
     * on its first request instead of calling the live API.
     */
    protected function ticketbutler()
    {
        $this->httpHistory = [];
        $handlerStack = HandlerStack::create(new MockHandler($this->httpResponses));
        $handlerStack->push(Middleware::history($this->httpHistory));

        return new Ticketbutler('test-token', 'example.ticketbutler.io', new Client([
            'base_uri' => 'https://example.ticketbutler.io/api/v3/',
            'handler' => $handlerStack,
        ]));
    }

    protected function lastRequest(): RequestInterface
    {
        $this->assertNotEmpty($this->httpHistory, 'No request was sent.');

        return end($this->httpHistory)['request'];
    }

    /**
     * Asserts the method, the path below /api/v3/, the query string and,
     * when given, the JSON body of the last request sent.
     */
    protected function assertRequest(string $method, string $path, string $query = '', ?array $json = null): void
    {
        $request = $this->lastRequest();

        $this->assertSame($method, $request->getMethod());
        $this->assertSame('/api/v3/'.$path, $request->getUri()->getPath());
        $this->assertSame($query, $request->getUri()->getQuery());

        if ($json !== null) {
            $this->assertSame($json, json_decode((string) $request->getBody(), true));
        }
    }
}
