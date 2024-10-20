<?php

namespace App;

use App\DrinkEnum;

class Tea extends Drink
{
    private const PRICE = 3;

    public function __construct()
    {
        parent::__construct(DrinkEnum::TEA, self::PRICE);
    }

    // Additional functionality can go here
}
