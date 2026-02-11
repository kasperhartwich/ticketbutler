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

Create a API token in your Ticketbutler account. You can find it under `General settings > API access`.

### General
``` php
use Ticketbutler\Ticketbutler;

$ticketbutler = new Ticketbutler('your-api-token', 'example.com');
$tickets = $ticketbutler->getTickets();
```
    
### Laravel
Add your Ticketbutler token and domain key to your `.env` file:
``` dotenv
TICKETBUTLER_TOKEN=your-token
TICKETBUTLER_DOMAIN=example.com
```

If you want to publish the config file you can run:
``` bash
php artisan vendor:publish --tag=ticketbutler
```

Using Ticketbutler in your controller:
``` php
use Ticketbutler\Ticketbutler;

class MyController extends Controller
{
    public function index(Ticketbutler $ticketbutler)
    {
        $tickets = $ticketbutler->getTickets();
    }
}
```

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
| Data Collection         | Delete Ticket Type                  | ❌                                         |
| Data Collection         | Create/Update Ticket Type Questions | ❌                                         |
| Data Collection         | Get Specific Question               | ✅ `getSpecificQuestion($eventUuid)`       |
| Data Collection         | Update Specific Question            | ❌                                         |
| Data Collection         | Delete Specific Question            | ❌                                         |
| Orders                  | Create Order                        | ❌                                         |
| Orders                  | Get a Specific Order                | ❌                                         |
| Orders                  | Get events orders                   | ✅ `getEventOrders($eventUuid)`            |
| Orders                  | Update order                        | ❌                                         |
| Orders                  | Refund an order                     | ❌                                         |
| Orders                  | Collect Order Data                  | ❌                                         |
| Orders                  | Get Collected Data from order       | ✅ `getCollectedDataFromOrder($orderUuid)` |
| Event Discount codes    | Create a discount code              | ✅ `createEventDiscountCode($eventUuid, $data)` |
| Event Discount codes    | Get event discount codes            | ✅ `getEventDiscountCodes($eventUuid)`     |
| Event Discount codes    | Toggle discount code                | ✅ `toggleEventDiscountCode($eventUuid, $discountCodeId)` |
| Event Discount codes    | Delete discount codes               | ✅ `deleteEventDiscountCode($eventUuid, $codeUuid)` |
| Generic Discount codes  | Create a discount code              | ❌                                         |
| Generic Discount codes  | Get discount codes                  | ✅ `getGenericDiscountCodes($eventUuid)`   |
| Generic Discount codes  | Toggle discount code                | ❌                                         |
| Generic Discount codes  | Delete doscount codes               | ❌                                         |
| Tickets                 | Get event tickets                   | ✅ `getTickets()`                          |
| Tickets                 | Get specific ticket                 | ❌                                         |
| Tickets                 | Update ticket details               | ❌                                         |
| Tickets                 | Collect Ticket Data                 | ❌                                         |
| Tickets                 | Get Ticket Specific Questions       | ❌                                         |
| Platform Data Exporting | Get all newsletter signups          | ✅ `getAllNewsletterSignups()`             |
| Platform Data Exporting | Get Orders by Month                 | ✅ `getGetOrdersByMonth()`                 |

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.