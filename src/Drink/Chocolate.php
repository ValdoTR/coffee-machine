<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Enum\DrinkEnum;

final class Chocolate extends Drink
{
    private const PRICE = 5;

    public function __construct()
    {
        parent::__construct(DrinkEnum::CHOCOLATE, self::PRICE);
    }

    // Additional functionality can go here
}
