<?php

namespace App;

use App\DrinkEnum;

abstract class DrinkDecorator extends Drink
{
    protected Drink $drink;

    public function __construct(Drink $drink)
    {
        $this->drink = $drink;
    }

    public function getName(): DrinkEnum
    {
        return $this->drink->getName();
    }

    public function getPrice(): int
    {
        return $this->drink->getPrice();
    }
}
