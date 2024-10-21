<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Drink\DrinkDecorator;
use App\Enum\DrinkEnum;

class MilkDecorator extends DrinkDecorator
{
    private int $milkLevel = 0; // Default milk level

    public function __construct(Drink $drinkObject, int $milkLevel)
    {
        parent::__construct($drinkObject);
        $this->milkLevel = $milkLevel;
    }

    public function getName(): DrinkEnum
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getMilkLevel(): int
    {
        return $this->milkLevel;
    }
}
