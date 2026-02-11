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

        $events = $this->ticketbutler()->getEvents();
        $this->assertSame('Laravel Live Denmark 2024', $events[0]->title);
        $this->assertSame('85c5effef5864bedb1ae0ac9d7a35bcd', $events[0]->uuid);
        $this->assertSame('http://laravellive.ticketbutler.io/e/laravel-live-denmark-2024/', $events[0]->url);
    }

    public function test_get_specific_event(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"address":{"first_name":"","full_name":" ","last_name":"","title":"","venue":"Werkstatt","business_name":"Laravel Denmark","cvr":"44349779","additional_info":"","street":"Refshalevej 167A","street_2":"","city":"Copenhagen K","postcode":"1432","country":"","phone":"","email":"tickets@laravellive.dk","language":""},"description":"","has_discount_code":true,"has_extras_types":false,"has_seating":false,"has_ticket_sold":true,"event_full_url":"https://laravellive.ticketbutler.io/e/laravel-live-denmark-2024/","event_extras_full_url":"https://laravellive.ticketbutler.io/e/laravel-live-denmark-2024/checkout/extras-types/","event_type":"REGULAR","images":[{"main":true,"image":"https://laravellive.ticketbutler.io/api/thumbs/events/e922bcc1ed9063cc113b96a6b28e8128_ba5a242cd2a94158acda4281e23d101f_1200x800.jpg","medium":"https://laravellive.ticketbutler.io/api/thumbs/events/e922bcc1ed9063cc113b96a6b28e8128_ba5a242cd2a94158acda4281e23d101f_600x600.jpg","small":"https://laravellive.ticketbutler.io/api/thumbs/events/e922bcc1ed9063cc113b96a6b28e8128_ba5a242cd2a94158acda4281e23d101f_100x100.jpg","uuid":"ba5a242cd2a94158acda4281e23d101f"}],"image":{"main":true,"uuid":"ba5a242c-d2a9-4158-acda-4281e23d101f","image":"https://cdn.ticketbutler.io/wl/bdb3534e0dce4107beb1e54122c40b58/events/85c5effef5864bedb1ae0ac9d7a35bcd/images/1701433046_04079b39730142999e9ca1c240b8fe6d.png","image_url":"https://laravellive.ticketbutler.io/api/thumbs/events/e922bcc1ed9063cc113b96a6b28e8128_ba5a242cd2a94158acda4281e23d101f_1200x800.jpg"},"is_expired":false,"is_free_event":false,"is_deleted":false,"is_min_team_organiser":true,"is_team_admin":true,"is_sold_out":false,"paid_out":false,"pin_str_long":"4800504","pk":70358,"price_range":{"min":500,"max":690},"sales_summary":{"total_tickets_sold":0,"total_tickets_reserved":0,"total_tickets_left":0,"total_revenue":0,"ticket_revenue":0,"extras_revenue":0,"total_tickets_for_sale":0,"ticket_type_summary":[]},"start_date":"2024-08-22T08:30+02:00","end_date":"2024-08-23T17:30+02:00","summary":"","ticket_types":[{"active":true,"amount_left":68,"amount_sold":132,"amount_total":200,"constraint_definition":null,"description":null,"extras_image_url":null,"fee":0,"has_advanced_settings":true,"invoice_price":null,"is_members_only":false,"is_tickets_sold":true,"is_temporarily_sold_out":false,"is_free":false,"is_on_sale":true,"pk":106359,"price":620,"sales_end_date":"2024-08-01T00:00+02:00","sales_start_date":null,"show_few_tickets_left_tag":false,"show_exact_tickets_left_count":false,"sold_out":false,"sort_id":2,"start_date":null,"title":"Regular Conference Ticket","deletable":false,"uuid":"1dcbc650d655464fbab625371b22c0b6"}],"tickets_export_url":"/api/events/85c5effef5864bedb1ae0ac9d7a35bcd/orders-export/","newsletter_export_url":"/api/events/85c5effef5864bedb1ae0ac9d7a35bcd/newsletters-export/","timezone":"Europe/Copenhagen","title":"Laravel Live Denmark 2024","title_url":"laravel-live-denmark-2024","send_event_statement_email_url":"/da/controltower/pages/85c5effef5864bedb1ae0ac9d7a35bcd/event/send-event-statement-email/","events_payout_report_pdf_url":"/api/events/85c5effef5864bedb1ae0ac9d7a35bcd/events-payout-report-pdf/","url":"https://laravellive.ticketbutler.io/e/laravel-live-denmark-2024/","uuid":"85c5effef5864bedb1ae0ac9d7a35bcd","eventsettings":{"attach_voucher":false,"attendee_can_edit":true,"attendee_can_refund":false,"barcode_active":false,"buy_tickets_button_link":null,"buy_tickets_button_text_da":null,"buy_tickets_button_text_en":null,"choose_tickets_button_text_da":null,"choose_tickets_button_text_en":null,"can_use_season_tickets":false,"end_attendee_refund_date":null,"event_ticket_limit_amount_initially":0,"event_ticket_limit_sold_out":false,"event_type":"organiser","fee_type":"organiser","generate_ticket_pdf":true,"has_end_date":true,"has_event_ticket_limit":false,"has_season_tickets":false,"invoice_payment_only":false,"invoice_payment_optional":false,"is_no_show_fee":false,"members_only_text":null,"mobile_pay_active":false,"no_orphan_seats":true,"order_ticket_limit":0,"organizer_absorb_fees":true,"purchase_success_text_da":null,"purchase_success_text_en":null,"refund_email_text":"","reminder_email_settings":"24_hours","reminder_email_text":"","show_price_with_vat":true,"show_tickets_left":false,"show_exact_tickets_left_count":true,"show_gift_card_expiry_date":true,"show_tag_few_tickets_left":false,"show_tickets_left_fewer_configured_values":true,"tickets_left_fewer_configured_values":{"show_tickets_left_fewer_count":100,"show_tickets_left_fewer_percent":0.15},"show_tickets_left_fewer_exact_number":null,"show_waiting_list":false,"use_no_qrcode_template_gift_card":false,"ticket_email_text":null,"ticket_limit":9,"send_emails":true,"ticket_limit_members_only":1,"vat_exempt":false},"date_range":null,"team_uuid":"204849b1ce7d4f08bd27cbf401dd6211","team":"8615: Laravel Denmark","is_members_only":false,"purchase_questions":{"uuid":"6fbdb885291341abbdc2cec0f27b9647","active":true,"questions":[{"uuid":"bb6746867c7246a287c46650f4a64c00","sort_id":0,"heading":"Company","active":true,"required":false,"variation":"COMPANY","choices":[],"ticket_type":null}]},"ticket_types_questions":[{"uuid":"d8a547d3d75e4a28aa055f0e33ff7688","active":true,"questions":[{"uuid":"3af1e0ec03284cf19defa98d92322463","sort_id":0,"heading":"Name","active":true,"required":false,"variation":"NAME","choices":[],"ticket_type":null},{"uuid":"55ca923067a544bca562c14b5be76c54","sort_id":1,"heading":"Twitter","active":true,"required":false,"variation":"TEXT","choices":[],"ticket_type":null}],"ticket_type_name":null}],"tags":[]}'
            ),
        ];

        $event = $this->ticketbutler()->getEvent('85c5effef5864bedb1ae0ac9d7a35bcd');
        $this->assertSame('Laravel Live Denmark 2024', $event->title);
        $this->assertSame('85c5effef5864bedb1ae0ac9d7a35bcd', $event->uuid);
        $this->assertSame('tickets@laravellive.dk', $event->address->email);
    }

    public function test_create_event(): void
    {
        $this->httpResponses = [
            new Response(
                201,
                ['Content-Type' => 'application/json'],
                '{"uuid":"aabbccdd11223344aabbccdd11223344","title":"New Test Event","start_date":"2025-06-15T10:00:00+02:00","ticket_types":[{"pk":1,"title":"General Admission","price":100}],"team":"8615: Laravel Denmark"}'
            ),
        ];

        $event = $this->ticketbutler()->createEvent([
            'title' => 'New Test Event',
            'start_date' => '2025-06-15T10:00:00+02:00',
            'ticket_types' => [['title' => 'General Admission', 'price' => 100]],
            'team' => '8615: Laravel Denmark',
        ]);
        $this->assertSame('New Test Event', $event->title);
        $this->assertSame('aabbccdd11223344aabbccdd11223344', $event->uuid);
    }

    public function test_update_event(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"uuid":"85c5effef5864bedb1ae0ac9d7a35bcd","title":"Updated Event Title","start_date":"2025-06-15T10:00:00+02:00"}'
            ),
        ];

        $event = $this->ticketbutler()->updateEvent('85c5effef5864bedb1ae0ac9d7a35bcd', [
            'title' => 'Updated Event Title',
        ]);
        $this->assertSame('Updated Event Title', $event->title);
        $this->assertSame('85c5effef5864bedb1ae0ac9d7a35bcd', $event->uuid);
    }

    public function test_delete_event(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{}'
            ),
        ];

        $result = $this->ticketbutler()->deleteEvent('85c5effef5864bedb1ae0ac9d7a35bcd', 'No longer needed');
        $this->assertIsObject($result);
    }
}
