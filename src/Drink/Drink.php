<?php declare(strict_types=1);

namespace App\Drink;

use App\Enum\DrinkEnum;

abstract class Drink
{
    public function __construct(protected DrinkEnum $name, protected int $price)
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
