<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Drink\DrinkDecorator;
use App\Enum\DrinkEnum;

class SugarDecorator extends DrinkDecorator
{
    private int $sugarLevel = 0; // Default sugar level

    public function __construct(Drink $drinkObject, int $sugarLevel)
    {
        parent::__construct($drinkObject);
        $this->sugarLevel = $sugarLevel;
    }

    public function getName(): DrinkEnum
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getSugarLevel(): int
    {
        return $this->sugarLevel;
    }
}
