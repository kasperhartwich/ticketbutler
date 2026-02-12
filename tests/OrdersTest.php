<?php

namespace Ticketbutler\Tests;

use GuzzleHttp\Psr7\Response;

final class OrdersTest extends TestCase
{
    public function test_get_specific_order(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"address":{"whitelabel":3989,"first_name":"Test","last_name":"Testesen","title":"","business_name":"","cvr":"","ean":"","ean_reference":"","street":"","street_2":"","city":"","postcode":"","country":"","phone":"+4530888000","email":"test@laravellive.dk","language":"en","full_address":"","pk":2721940,"venue":null},"uuid":"13e0a4ca6565403f818f61872ab82613","state":"REFUND","tickets":[{"amount":1,"tickets":[{"full_name":"Test Testesen","uuid":"99fd2005b9e54715992e371ac44fdd18"}]}]}'),
        ];

        $eventOrder = $this->ticketbutler()->getSpecificOrder('85c5effef5864bedb1ae0ac9d7a35bcd');
        $this->assertSame('13e0a4ca6565403f818f61872ab82613', $eventOrder->uuid);
        $this->assertSame('Test Testesen', $eventOrder->tickets[0]->tickets[0]->full_name);
        $this->assertSame('REFUND', $eventOrder->state);
    }

    public function test_get_event_orders(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"uuid":"85c5effe-f586-4bed-b1ae-0ac9d7a35bcd","orders":[{"uuid":"13e0a6ca-6865-403f-818f-61872ab83724","order_id":"7g12241027","currency":"EUR","order_lines":[{"uuid":"69b188a5-6ef3-41a3-adc4-32dea24349b1","ticket_description":"There is a limited amount of early bird tickets.","discount_total":null,"gift_card_total":null,"gift_card_ticket":null,"has_ticket_type_date":false,"ticket_type_date":"2024-08-22T08:30+02:00","seating":[],"quantity":1,"title":"Early Bird Conference Ticket","price":"500.00","total":"500.00","type":"ticket"}],"state":"REFUND","date":"2024-01-03T19:40:16.831127Z","vat_exempt":false,"vat_rate":0.25,"address":{"first_name":"Test","last_name":"Testesen","email":"test@laravellive.dk","phone":"+4530888000"},"news_letter":true,"payment_method":"STRIPE_CONNECT","tickets":[{"attribute_selected":null,"checked_in":false,"company_name":"","email":"test@laravellive.dk","external_uuid":null,"full_name":"Test Testesen","has_ticket_type_date":false,"id":3960129,"purchase_uuid":"13e0a6ca6865403f818f61872ab83724","price":"500.00","price_total":"500.00","ticket_answer_collection":{"uuid":"b4445122c84643b2b0cc030c08f8e660","answers":[{"uuid":"49546ff8d27b40fe9801f958b1f45485","answer_collection":1039533,"question":28009,"variation":"TEXT","question_heading":"Twitter Handle","question_uuid":"55ca923067a544bca562c14b5be76c54","answer_value":"laravellive","answered_choices":[]},{"uuid":"f565a5a99266457b9b88b7277eb04e11","answer_collection":1039533,"question":28010,"variation":"SELECT","question_heading":"T-shirt size","question_uuid":"2dfbf14918d4439fa3ccc61f15bfa413","answer_value":"","answered_choices":[{"choice_uuid":"8ebff7deb2e247c4af6569b1299bb7fd","choice_heading":"X-Large"}]}]},"ticket_download_absolute_url":"","ticket_refund":true,"ticket_type_date":"2024-08-22T08:30+02:00","ticket_type_name":"Early Bird Conference Ticket","ticket_type_pk":105938,"uuid":"99fd2005b9e54715992e371ac44fdd18","questions":[{"uuid":"55ca923067a544bca562c14b5be76c54","sort_id":0,"heading":"Twitter","active":true,"required":false,"variation":"TEXT","choices":[],"ticket_type":null},{"uuid":"2dfbf14918d4439fa3ccc61f15bfa413","sort_id":3,"heading":"T-shirt size","active":true,"required":false,"variation":"SELECT","choices":[{"uuid":"77a4ad56b6564b54931be90f20886bf0","choice_parent_uuid":"77a4ad56b6564b54931be90f20886bf0","sort_id":1,"label":"Medium","label_da":null,"description":null,"description_da":null,"used":8,"limit":null},{"uuid":"303d999e517f4983a12dd7c3d1c901d8","choice_parent_uuid":"303d999e517f4983a12dd7c3d1c901d8","sort_id":2,"label":"Large","label_da":null,"description":null,"description_da":null,"used":12,"limit":null}],"ticket_type":null}],"answers":[{"uuid":"49546ff8d27b40fe9801f958b1f45485","answer_collection":1039533,"question":28009,"variation":"TEXT","question_heading":"Twitter Handle","question_uuid":"55ca923067a544bca562c14b5be76c54","answer_value":"laravellive","answered_choices":[]},{"uuid":"f565a5a99266457b9b88b7277eb04e11","answer_collection":1039533,"question":28010,"variation":"SELECT","question_heading":"T-shirt size","question_uuid":"2dfbf14918d4439fa3ccc61f15bfa413","answer_value":"","answered_choices":[{"choice_uuid":"77a4ad56b6564b54931be90f20886bf0","choice_heading":"Medium"}]}]}]},{"uuid":"4de46117-f027-4984-b31a-79522a230d46","order_id":"7g12243016","currency":"EUR","order_lines":[{"uuid":"69b188a5-6ef3-41a3-adc4-32dea24349b1","ticket_description":"There is a limited amount of early bird tickets.","discount_total":50,"gift_card_total":null,"gift_card_ticket":null,"has_ticket_type_date":false,"ticket_type_date":"2024-08-22T08:30+02:00","seating":[],"quantity":1,"title":"Early Bird Conference Ticket","price":"500.00","total":"500.00","type":"ticket"}],"state":"PAID","date":"2024-01-05T15:07:18.187036Z","vat_exempt":false,"vat_rate":0.25,"address":{"first_name":"Kasper","last_name":"Hartwich","email":"kasper@laravellive.dk","phone":"+4530888000","address":"Åvendingen 2A"},"news_letter":true,"payment_method":"","tickets":[{"attribute_selected":null,"checked_in":false,"company_name":"Laravel Live Denmark","email":"kasper@laravellive.dk","external_uuid":null,"full_name":"Kasper Hartwich","has_ticket_type_date":false,"id":3964096,"purchase_uuid":"4de46117f0274984b31a79522a230d46","price":"500.00","price_total":"0.00","ticket_answer_collection":{"uuid":"c536f218fb6b4c0db2f24ba038f8a273","answers":[{"uuid":"c13d6c61b1474a1984b002715286e7af","answer_collection":1040070,"question":28010,"variation":"SELECT","question_heading":"T-shirt size","question_uuid":"2dfbf14918d4439fa3ccc61f15bfa413","answer_value":"","answered_choices":[{"choice_uuid":"a0c7c0b7b6114d04875f340fc1d27c26","choice_heading":"XX-Large"}]},{"uuid":"b3d7f81f90d140f88b21a6bcb4def6d2","answer_collection":1040070,"question":29181,"variation":"NAME","question_heading":"Name","question_uuid":"3af1e0ec03284cf19defa98d92322463","answer_value":"Kasper Hartwich","answered_choices":[]},{"uuid":"2ea22c20cfc746b089d46a28fd2f3f4d","answer_collection":1040070,"question":29182,"variation":"COMPANY","question_heading":"Company (for namebadge)","question_uuid":"280a705c092d49d7aa8a1374b1067e93","answer_value":"Laravel Live Denmark","answered_choices":[]},{"uuid":"837a7520040c486093c2f04c85bca247","answer_collection":1040070,"question":28009,"variation":"TEXT","question_heading":"Twitter Handle","question_uuid":"55ca923067a544bca562c14b5be76c54","answer_value":"kasperh","answered_choices":[]}]},"ticket_download_absolute_url":"","ticket_refund":false,"ticket_type_date":"2024-08-22T08:30+02:00","ticket_type_name":"Early Bird Conference Ticket","ticket_type_pk":105938,"uuid":"9c5325fb8cb947af996fd361715ef605","questions":[{"uuid":"55ca923067a544bca562c14b5be76c54","sort_id":0,"heading":"Twitter","active":true,"required":false,"variation":"TEXT","choices":[],"ticket_type":null},{"uuid":"2dfbf14918d4439fa3ccc61f15bfa413","sort_id":3,"heading":"T-shirt size","active":true,"required":false,"variation":"SELECT","choices":[{"uuid":"77a4ad56b6564b54931be90f20886bf0","choice_parent_uuid":"77a4ad56b6564b54931be90f20886bf0","sort_id":1,"label":"Medium","label_da":null,"description":null,"description_da":null,"used":8,"limit":null},{"uuid":"303d999e517f4983a12dd7c3d1c901d8","choice_parent_uuid":"303d999e517f4983a12dd7c3d1c901d8","sort_id":2,"label":"Large","label_da":null,"description":null,"description_da":null,"used":12,"limit":null}],"ticket_type":null}],"answers":[{"uuid":"c13d6c61b1474a1984b002715286e7af","answer_collection":1040070,"question":28010,"variation":"SELECT","question_heading":"T-shirt size","question_uuid":"2dfbf14918d4439fa3ccc61f15bfa413","answer_value":"","answered_choices":[{"choice_uuid":"303d999e517f4983a12dd7c3d1c901d8","choice_heading":"Large"}]},{"uuid":"837a7520040c486093c2f04c85bca247","answer_collection":1040070,"question":28009,"variation":"TEXT","question_heading":"Twitter","question_uuid":"55ca923067a544bca562c14b5be76c54","answer_value":"kasperh","answered_choices":[]}]}],"discount":{"code":"SUPERDISCOUNT","type":"PERCENTAGE","amount":10}}]}'),
        ];

        $eventOrders = $this->ticketbutler()->getEventOrders('85c5effef5864bedb1ae0ac9d7a35bcd');
        $this->assertSame('13e0a6ca-6865-403f-818f-61872ab83724', $eventOrders->orders[0]->uuid);
        $this->assertSame('Test Testesen', $eventOrders->orders[0]->tickets[0]->full_name);
        $this->assertSame('REFUND', $eventOrders->orders[0]->state);

        $this->assertSame('Kasper Hartwich', $eventOrders->orders[1]->tickets[0]->full_name);
        $this->assertSame('PAID', $eventOrders->orders[1]->state);
    }

    public function test_get_collected_data_from_order(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"purchase":"d2fc0aa042cc4410be9b9107ede843cc","answers":[{"uuid":"75bc3918c7034c8281e09d2c4e489864","question":"bb6746867c7246a287c46650f4a64c00","variation":"COMPANY","question_heading":"Company","answer_value":"Super Firma","answered_choices":[]},{"uuid":"e657075dd82c4e44bd0ed31146244b6f","question":"dcb8f31d60414539b70fc823daa985fa","variation":"TEXT","question_heading":"Address","answer_value":"Frederiksberg Allé 2","answered_choices":[]},{"uuid":"6641f90d2f624ee2a7b0a48c9d4c73e0","question":"d3de27bb274a488c82f6861b335c38bc","variation":"TEXT","question_heading":"Zipcode","answer_value":"2000","answered_choices":[]},{"uuid":"a7e8cd04ac8e4ef88e17cc1044a73dd9","question":"318090ed39c94af09a309ff4855af5d2","variation":"TEXT","question_heading":"City","answer_value":"Frederiksberg","answered_choices":[]},{"uuid":"09cf894e9d0b48f793f15cff8b1c7bf1","question":"2aa67a402f74447fa805222a22a156d7","variation":"TEXT","question_heading":"Country","answer_value":"Denmark","answered_choices":[]}]}'),
        ];

        $answers = $this->ticketbutler()->getCollectedDataFromOrder('d2fc0aa0-42cc-4410-be9b-9107ede843cc');

        $this->assertSame('d2fc0aa042cc4410be9b9107ede843cc', $answers->purchase);
        $this->assertSame('Company', $answers->answers[0]->question_heading);
        $this->assertSame('Super Firma', $answers->answers[0]->answer_value);
    }
}
