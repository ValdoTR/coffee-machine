<?php

declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Enum\DrinkEnum;

final class Coffee extends Drink
{
    public function __construct()
    {
        parent::__construct(DrinkEnum::COFFEE, DrinkEnum::COFFEE->price());
    }

    // Additional functionality can go here
}
