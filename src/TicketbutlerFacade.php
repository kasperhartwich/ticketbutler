<?php

namespace Ticketbutler;

use Illuminate\Support\Facades\Facade;

class TicketbutlerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ticketbutler';
    }
}