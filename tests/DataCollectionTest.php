<?php


use GuzzleHttp\Psr7\Response;

final class DataCollectionTest extends \Ticketbutler\Tests\TestCase
{
    public function test_get_ticket_type_questions(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '[{"uuid":"d8a547d3d75e4a28aa055f0e33ff7688","active":true,"questions":[{"uuid":"3af1e0ec03284cf19defa98d92322463","sort_id":0,"heading":"Name","active":true,"required":false,"variation":"NAME","choices":[],"ticket_type":null},{"uuid":"55ca923067a544bca562c14b5be76c54","sort_id":1,"heading":"Twitter","active":true,"required":false,"variation":"TEXT","choices":[],"ticket_type":null}],"ticket_type_name":null}]'
            ),
        ];

        $ticketTypeQuestions = $this->ticketbutler()->getTicketTypeQuestions('85c5effef5864bedb1ae0ac9d7a35bcd');
        $this->assertTrue($ticketTypeQuestions[0]['active']);
        $this->assertSame('Twitter', $ticketTypeQuestions[0]['questions'][1]['heading']);
        $this->assertSame('TEXT', $ticketTypeQuestions[0]['questions'][1]['variation']);
    }

    public function test_get_purchase_questions(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"uuid":"6fbdb885291341abbdc2cec0f27b9647","active":true,"questions":[{"uuid":"dcb8f31d60414539b70fc823daa985fa","sort_id":0,"heading":"Address","active":true,"required":true,"variation":"TEXT","choices":[],"ticket_type":null},{"uuid":"318090ed39c94af09a309ff4855af5d2","sort_id":1,"heading":"City","active":true,"required":true,"variation":"TEXT","choices":[],"ticket_type":null},{"uuid":"2aa67a402f74447fa805222a22a156d7","sort_id":2,"heading":"Country","active":true,"required":true,"variation":"TEXT","choices":[],"ticket_type":null}]}'
            ),
        ];

        $purchaseQuestions = $this->ticketbutler()->getPurchaseQuestions('85c5effef5864bedb1ae0ac9d7a35bcd');
        $this->assertTrue($purchaseQuestions['active']);
        $this->assertTrue($purchaseQuestions['questions'][1]['active']);
        $this->assertSame('City', $purchaseQuestions['questions'][1]['heading']);
        $this->assertSame('TEXT', $purchaseQuestions['questions'][1]['variation']);
    }

    public function test_get_specific_question(): void
    {
        $this->httpResponses = [
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"uuid":"280a705c092d49d7aa8a1374b1067e93","sort_id":1,"heading":"Company","active":true,"required":false,"variation":"COMPANY","choices":[],"ticket_type":null}'
            ),
        ];

        $question = $this->ticketbutler()->getSpecificQuestion('85c5effef5864bedb1ae0ac9d7a35bcd', '280a705c092d49d7aa8a1374b1067e93');
        $this->assertTrue($question['active']);
        $this->assertSame('Company', $question['heading']);
        $this->assertSame('COMPANY', $question['variation']);
    }
}
