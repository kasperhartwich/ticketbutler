<?php

namespace Ticketbutler\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Ticketbutler\Ticketbutler;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var Ticketbutler */
    protected $ticketbutler;

    /** @var array */
    protected $httpResponses = [];

    protected function ticketbutler()
    {
        if (! empty($this->httpResponses)) {
            $mock = new MockHandler($this->httpResponses);
            $handlerStack = HandlerStack::create($mock);
            $client = new Client(['handler' => $handlerStack]);
        }

        return new Ticketbutler(
            getenv('TICKETBUTLER_TOKEN'),
            getenv('TICKETBUTLER_DOMAIN'),
            $client ?? null
        );
    }
}
