<?php

declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Enum\DrinkEnum;

final class Tea extends Drink
{
    public function __construct()
    {
        parent::__construct(DrinkEnum::TEA, DrinkEnum::TEA->price());
    }

    // Additional functionality can go here
}
