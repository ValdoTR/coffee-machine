<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Enum\DrinkEnum;

final class Tea extends Drink
{
    private const PRICE = 3;

    public function __construct()
    {
        parent::__construct(DrinkEnum::TEA, self::PRICE);
    }

    // Additional functionality can go here
}
