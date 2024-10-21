<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Drink\DrinkDecorator;

class SugarDecorator extends DrinkDecorator
{
    protected int $sugarLevel = 0;

    public function __construct(Drink $drinkObject, int $sugarLevel) {
        parent::__construct($drinkObject);
        $this->sugarLevel = $sugarLevel;
    }

    public function getPrice(): int
    {
        return parent::getPrice(); // Or adjust if sugar has a cost
    }

    public function getSugarLevel(): int {
        return $this->sugarLevel;
    }
}
