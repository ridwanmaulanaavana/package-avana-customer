<?php

namespace Ridwan\Customer;

use Illuminate\Support\Facades\Facade;

class AvanaCustomer extends Facade 
{

    protected static function getFacadeAccessor() 
    { 
       return 'AvanaCustomer'; 
    }
}