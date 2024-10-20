<?php

namespace App;

use App\DrinkEnum;

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
