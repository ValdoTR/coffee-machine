<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Drink\DrinkDecorator;

class MilkDecorator extends DrinkDecorator
{
    protected int $milkLevel = 0;

    public function __construct(Drink $drinkObject, int $milkLevel) {
        parent::__construct($drinkObject);
        $this->milkLevel = $milkLevel;
    }

    public function getPrice(): int
    {
        return parent::getPrice(); // Or adjust if milk has a cost
    }

    public function getMilkLevel(): int {
        return $this->milkLevel;
    }
}
