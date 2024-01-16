<?php
namespace Ticketbutler\Tests;

use GuzzleHttp\Psr7\Response;

final class EventsTest extends TestCase
{
    public function test_get_events(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '[{"uuid":"85c5effef5864bedb1ae0ac9d7a35bcd","title":"Laravel Live Denmark 2024","custom_questions":{"questions_collection":{},"answers_collection":{}},"start_date":"2024-08-22T08:30:00+02:00","images":[{"main":true,"image":"https://laravellive.ticketbutler.io/api/thumbs/events/e922bcc1ed9063cc113b96a6b28e8128_ba5a242cd2a94158acda4281e23d101f_1200x800.jpg","medium":"https://laravellive.ticketbutler.io/api/thumbs/events/e922bcc1ed9063cc113b96a6b28e8128_ba5a242cd2a94158acda4281e23d101f_600x600.jpg","small":"https://laravellive.ticketbutler.io/api/thumbs/events/e922bcc1ed9063cc113b96a6b28e8128_ba5a242cd2a94158acda4281e23d101f_100x100.jpg","uuid":"ba5a242cd2a94158acda4281e23d101f"}],"address":{"whitelabel":3989,"first_name":"","last_name":"","title":"","business_name":"Laravel Denmark","cvr":"44349779","ean":"","ean_reference":"","street":"Refshalevej 167A","street_2":"","city":"Copenhagen K","postcode":"1432","country":"","phone":"","email":"tickets@laravellive.dk","language":"","full_address":"Refshalevej 167A, 1432, Copenhagen K","pk":2644954,"venue":"Werkstatt"},"is_expired":false,"price_min":500.0,"price_max":690.0,"currency":"EUR","members_only":false,"description":"","summary":"","sold_out":false,"tags":[],"title_url":"laravel-live-denmark-2024","url":"http://laravellive.ticketbutler.io/e/laravel-live-denmark-2024/"}]'
            ),
        ];

        $events = $this->ticketbutler()->events();
        $this->assertSame('Laravel Live Denmark 2024', $events[0]['title']);
        $this->assertSame('85c5effef5864bedb1ae0ac9d7a35bcd', $events[0]['uuid']);
        $this->assertSame('http://laravellive.ticketbutler.io/e/laravel-live-denmark-2024/', $events[0]['url']);
    }
}
