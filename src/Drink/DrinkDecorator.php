<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Enum\DrinkEnum;

abstract class DrinkDecorator extends Drink
{
    public function __construct(protected Drink $drinkObject)
    {
    }

    public function getName(): DrinkEnum
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
