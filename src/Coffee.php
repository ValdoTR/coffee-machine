<?php

namespace App;

use App\DrinkEnum;

class Coffee extends Drink
{
    private const PRICE = 2;

    public function __construct()
    {
        parent::__construct(DrinkEnum::COFFEE, self::PRICE);
    }

    // Additional functionality can go here
}
