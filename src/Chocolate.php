<?php

namespace App;

use App\DrinkEnum;

class Chocolate extends Drink
{
    private const PRICE = 5;

    public function __construct()
    {
        parent::__construct(DrinkEnum::CHOCOLATE, self::PRICE);
    }

    // Additional functionality can go here
}
