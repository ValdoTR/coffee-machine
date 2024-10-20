<?php declare(strict_types=1);

namespace App\Drink;

use App\Enum\DrinkEnum;

abstract class Drink
{
    protected DrinkEnum $name;
    protected int $price;

    public function __construct(DrinkEnum $name, int $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): DrinkEnum
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    // Additional methods related to drinks can be added here
}
