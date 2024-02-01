<?php

namespace Ticketbutler\Tests;

use GuzzleHttp\Psr7\Response;

final class PlatformDataExportingTest extends TestCase
{
    public function test_get_all_newsletter_signups_json(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '[{"first_name":"Jens","last_name":"jensen","date_joined":"2024-01-11T21:41:21.076482+01:00","email":"jens.jensen@example.com","newsletter_event":"Laravel Live Denmark 2024","team":"Laravel Denmark"},{"first_name":"Test","last_name":"Kasper","date_joined":"2024-01-03T20:40:55.753193+01:00","email":"test@example.org","newsletter_event":"Laravel Live Denmark 2024","team":"Laravel Denmark"}]'),
        ];

        $newsletterSignups = $this->ticketbutler()->getAllNewsletterSignups('json');
        $this->assertSame('Jens', $newsletterSignups[0]->first_name);
        $this->assertSame('jens.jensen@example.com', $newsletterSignups[0]->email);

        $this->assertSame('2024-01-03T20:40:55.753193+01:00', $newsletterSignups[1]->date_joined);
        $this->assertSame('test@example.org', $newsletterSignups[1]->email);
    }

    public function test_get_all_newsletter_signups_xlsx(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'text/html; charset=utf-8'],
                'Email with newsletter data will be sent to <b>test@example.orgk</b>'),
        ];

        $emailSent = $this->ticketbutler()->getAllNewsletterSignups('xlsx');
        $this->assertTrue($emailSent);
    }

    public function test_get_orders_by_month(): void
    {
        $this->httpResponses = [new Response(200)];

        $emailSent = $this->ticketbutler()->getGetOrdersByMonth(2024, 1, 'test@example.org');
        $this->assertTrue($emailSent);
    }
}
