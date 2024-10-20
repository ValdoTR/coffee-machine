<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Enum\DrinkEnum;

final class Coffee extends Drink
{
    private const PRICE = 2;

    public function __construct()
    {
        parent::__construct(DrinkEnum::COFFEE, self::PRICE);
    }

    // Additional functionality can go here
}
