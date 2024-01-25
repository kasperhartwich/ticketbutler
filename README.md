# Ticketbutler
This is a client for the [Ticketbutler API](https://lab.ticketbutler.io).

## Installation

You can install the package via composer:

``` bash
composer require kasperhartwich/ticketbutler
```

Add your Ticketbutler Token and domain key to your `.env` file:
``` dotenv
TICKETBUTLER_TOKEN=your-token
TICKETBUTLER_DOMAIN=example.com
```

## Usage

``` php
use Ticketbutler\Ticketbutler;

class MyController extends Controller
{
    public function index(Ticketbutler $ticketbutler)
    {
        $tickets = $ticketbutler->tickets();
    }
}
```

## Testing

``` bash
vendor/bin/phpunit
```

## Supported API methods
| Section                 | Method                              | Support | Usage                                                |
|-------------------------|-------------------------------------|---------|------------------------------------------------------|
| Events                  | Get all Events                      | ✅       | `$ticketbutler->getEvents()`                         |
| Events                  | Create an event                     | ❌       |                                                      |
| Events                  | Get Specific Event                  | ✅       | `$ticketbutler->getEvent($eventUuid)`                |
| Events                  | Update event                        | ❌       |                                                      |
| Events                  | Delete event                        | ❌       |                                                      |
| Ticket types            | Get event ticket types              | ✅       | `$ticketbutler->getEventTicketTypes($eventUuid)`     |
| Ticket types            | Create Ticket Type                  | ❌       |                                                      |
| Ticket types            | Get Specific Ticket Type            | ❌       |                                                      |
| Ticket types            | Update Ticket Type                  | ❌       |                                                      |
| Ticket types            | Delete Ticket Type                  | ❌       |                                                      |
| Data Collection         | Get Ticket Type Questions           | ❌       |                                                      |
| Data Collection         | Get Purchase Questions              | ❌       |                                                      |
| Data Collection         | Delete Ticket Type                  | ❌       |                                                      |
| Data Collection         | Create/Update Ticket Type Questions | ❌       |                                                      |
| Data Collection         | Get Specific Question               | ❌       |                                                      |
| Data Collection         | Update Specific Question            | ❌       |                                                      |
| Data Collection         | Delete Specific Question            | ❌       |                                                      |
| Orders                  | Create Order                        | ❌       |                                                      |
| Orders                  | Get a Specific Order                | ❌       |                                                      |
| Orders                  | Get events orders                   | ✅       | `$ticketbutler->getEventOrders($eventUuid)`          |
| Orders                  | Update order                        | ❌       |                                                      |
| Orders                  | Refund an order                     | ❌       |                                                      |
| Orders                  | Collect Order Data                  | ❌       |                                                      |
| Orders                  | Get Collected Data from order       | ❌       |                                                      |
| Event Discount codes    | Create a discount code              | ❌       |                                                      |
| Event Discount codes    | Get event discount codes            | ✅       | `$ticketbutler->getEventDiscountCodes($eventUuid)`   |
| Event Discount codes    | Toggle discount code                | ❌       |                                                      |
| Event Discount codes    | Delete discount codes               | ❌       |                                                      |
| Generic Discount codes  | Create a discount code              | ❌       |                                                      |
| Generic Discount codes  | Get discount codes                  | ✅       | `$ticketbutler->getGenericDiscountCodes($eventUuid)` |
| Generic Discount codes  | Toggle discount code                | ❌       |                                                      |
| Generic Discount codes  | Delete doscount codes               | ❌       |                                                      |
| Tickets                 | Get event tickets                   | ✅       | `$ticketbutler->getTickets()`                        |
| Tickets                 | Get specific ticket                 | ❌       |                                                      |
| Tickets                 | Update ticket details               | ❌       |                                                      |
| Tickets                 | Collect Ticket Data                 | ❌       |                                                      |
| Tickets                 | Get Ticket Specific Questions       | ❌       |                                                      |
| Platform Data Exporting | Get all newsletter signups          | ✅       | `$ticketbutler->getAllNewsletterSignups()`           |
| Platform Data Exporting | Get Orders by Month                 | ✅       | `$ticketbutler->getGetOrdersByMonth()`               |

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.