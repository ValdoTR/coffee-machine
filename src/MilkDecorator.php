<?php

namespace App;

use App\DrinkEnum;

class MilkDecorator extends DrinkDecorator
{
    private int $milkLevel;

    public function __construct(Drink $drink, int $milkLevel)
    {
        parent::__construct($drink);
        $this->milkLevel = $milkLevel;
    }

    public function getName(): DrinkEnum
    {
        return $this->drink->getName();
    }

    public function getPrice(): int
    {
        // No additional cost but we keep it for potential future changes
        return parent::getPrice();
    }

    public function getMilkLevel(): int
    {
        return $this->milkLevel;
    }
}
