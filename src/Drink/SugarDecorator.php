<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Drink\DrinkDecorator;
use App\Enum\DrinkEnum;

class SugarDecorator extends DrinkDecorator
{
    private int $sugarLevel;

    public function __construct(Drink $drink, int $sugarLevel)
    {
        parent::__construct($drink);
        $this->sugarLevel = $sugarLevel;
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
        return $this->sugarLevel;
    }
}