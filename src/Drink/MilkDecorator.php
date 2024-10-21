<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Drink\DrinkDecorator;

class MilkDecorator extends DrinkDecorator
{
    protected int $milkLevel = 0; // Default milk level

    public function __construct(Drink $drinkObject, int $milkLevel)
    {
        parent::__construct($drinkObject);
        $this->milkLevel = $milkLevel;
    }

    public function getMilkLevel(): int
    {
        return $this->milkLevel;
    }
}
