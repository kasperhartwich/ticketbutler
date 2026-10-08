# Ticketbutler

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kasperhartwich/ticketbutler.svg?style=flat-square)](https://packagist.org/packages/kasperhartwich/ticketbutler)
[![Tests](https://img.shields.io/github/actions/workflow/status/kasperhartwich/ticketbutler/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/kasperhartwich/ticketbutler/actions/workflows/tests.yml)


This is a client for the [Ticketbutler API](https://lab.ticketbutler.io).

## Requirements
* PHP 8.1
* Laravel =>8.x

## Installation

You can install the package via composer:

``` bash
composer require kasperhartwich/ticketbutler
```

## Usage

Create an API token in your Ticketbutler account. You can find it under `General settings > API access`.

### General
``` php
use Ticketbutler\Ticketbutler;

$ticketbutler = new Ticketbutler('your-api-token', 'example.com');
$tickets = $ticketbutler->getTickets('your-event-uuid');
```
    
### Laravel
Add your Ticketbutler token and domain key to your `.env` file:
``` dotenv
TICKETBUTLER_TOKEN=your-token
TICKETBUTLER_DOMAIN=example.com
```

If you want to publish the config file you can run:
``` bash
php artisan vendor:publish --tag=ticketbutler-config
```

Using Ticketbutler in your controller:
``` php
use Ticketbutler\Ticketbutler;

class MyController extends Controller
{
    public function index(Ticketbutler $ticketbutler)
    {
        $tickets = $ticketbutler->getTickets('your-event-uuid');
    }
}
```

### Return values
Methods return the API's JSON decoded into `stdClass` objects, or arrays of them for endpoints that answer with a list:

``` php
$event = $ticketbutler->getEvent('your-event-uuid');
echo $event->title;

foreach ($ticketbutler->getEvents() as $event) {
    echo $event->uuid;
}
```

A few methods return a boolean instead: `ping()` and `getOrdersByMonth()` return `true` when the API answers with status 200, and `getAllNewsletterSignups('xlsx')` returns `true` when the API confirms that it will email the export.

### Errors
Requests are made with [Guzzle](https://docs.guzzlephp.org/), and its exceptions are passed on unchanged. With the default client:

- `GuzzleHttp\Exception\ClientException` for 4xx responses (an invalid token, an unknown UUID, invalid data),
- `GuzzleHttp\Exception\ServerException` for 5xx responses,
- `GuzzleHttp\Exception\ConnectException` when the API cannot be reached.

All of them implement `GuzzleHttp\Exception\GuzzleException`. A 4xx or 5xx exception carries the response, so you can read the API's error message:

``` php
use GuzzleHttp\Exception\ClientException;

try {
    $event = $ticketbutler->getEvent('unknown-uuid');
} catch (ClientException $e) {
    $status = $e->getResponse()->getStatusCode();
    $body = (string) $e->getResponse()->getBody();
}
```

### Custom HTTP client
You can pass your own Guzzle client as the third argument, for example to set timeouts or add middleware. The token and domain are then not used, so the client must set the base URI and the `Authorization` header itself:

``` php
use GuzzleHttp\Client;
use Ticketbutler\Ticketbutler;

$client = new Client([
    'base_uri' => 'https://example.com/api/v3/',
    'headers' => [
        'Authorization' => 'Token your-api-token',
        'Content-Type' => 'application/json; charset=utf-8',
    ],
    'timeout' => 30,
]);

$ticketbutler = new Ticketbutler('your-api-token', 'example.com', $client);
```

Keep Guzzle's `http_errors` option on (the default), or 4xx and 5xx responses will not throw the exceptions listed under [Errors](#errors).

## Testing

``` bash
composer test
```

## Supported API methods
| Section                 | Method                              | Supported                                 |
|-------------------------|-------------------------------------|-------------------------------------------|
| Events                  | Get all Events                      | ✅ `getEvents()`                           |
| Events                  | Create an event                     | ✅ `createEvent($data)`                    |
| Events                  | Get Specific Event                  | ✅ `getEvent($eventUuid)`                  |
| Events                  | Update event                        | ✅ `updateEvent($eventUuid, $data)`        |
| Events                  | Delete event                        | ✅ `deleteEvent($eventUuid, $deleteReason)` |
| Ticket types            | Get event ticket types              | ✅ `getEventTicketTypes($eventUuid)`       |
| Ticket types            | Create Ticket Type                  | ❌                                         |
| Ticket types            | Get Specific Ticket Type            | ❌                                         |
| Ticket types            | Update Ticket Type                  | ❌                                         |
| Ticket types            | Delete Ticket Type                  | ❌                                         |
| Data Collection         | Get Ticket Type Questions           | ✅ `getTicketTypeQuestions($eventUuid)`    |
| Data Collection         | Get Purchase Questions              | ✅ `getPurchaseQuestions($eventUuid)`      |
| Data Collection         | Create/Update Ticket Type Questions | ❌                                         |
| Data Collection         | Get Specific Question               | ✅ `getSpecificQuestion($eventUuid, $questionUuid)` |
| Data Collection         | Update Specific Question            | ❌                                         |
| Data Collection         | Delete Specific Question            | ❌                                         |
| Orders                  | Create Order                        | ❌                                         |
| Orders                  | Get a Specific Order                | ✅ `getSpecificOrder($orderUuid)`          |
| Orders                  | Get events orders                   | ✅ `getEventOrders($eventUuid)`            |
| Orders                  | Update order                        | ❌                                         |
| Orders                  | Refund an order                     | ❌                                         |
| Orders                  | Collect Order Data                  | ❌                                         |
| Orders                  | Get Collected Data from order       | ✅ `getCollectedDataFromOrder($orderUuid)` |
| Event Discount codes    | Create a discount code              | ✅ `createEventDiscountCode($eventUuid, $data)` |
| Event Discount codes    | Get event discount codes            | ✅ `getEventDiscountCodes($eventUuid)`     |
| Event Discount codes    | Toggle discount code                | ✅ `toggleEventDiscountCode($eventUuid, $discountCodeId)` |
| Event Discount codes    | Delete discount codes               | ✅ `deleteEventDiscountCode($eventUuid, $codeUuid)` |
| Generic Discount codes  | Create a discount code              | ✅ `createGenericDiscountCode($data)`      |
| Generic Discount codes  | Get discount codes                  | ✅ `getGenericDiscountCodes()`             |
| Generic Discount codes  | Toggle discount code                | ✅ `toggleGenericDiscountCode($codeId)`    |
| Generic Discount codes  | Delete discount codes               | ✅ `deleteGenericDiscountCode($codeId)`    |
| Tickets                 | Get event tickets                   | ✅ `getTickets($eventUuid)`                |
| Tickets                 | Get specific ticket                 | ❌                                         |
| Tickets                 | Update ticket details               | ❌                                         |
| Tickets                 | Collect Ticket Data                 | ❌                                         |
| Tickets                 | Get Ticket Specific Questions       | ❌                                         |
| Platform Data Exporting | Get all newsletter signups          | ✅ `getAllNewsletterSignups()`             |
| Platform Data Exporting | Get Orders by Month                 | ✅ `getOrdersByMonth()`                    |
| Webhooks                | Test access to the webhooks         | ❌                                         |
| Webhooks                | Create webhook                      | ❌                                         |
| Webhooks                | List webhooks                       | ❌                                         |
| Webhooks                | Get webhook                         | ❌                                         |
| Webhooks                | Update webhook                      | ❌                                         |
| Webhooks                | Delete webhook                      | ❌                                         |

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.