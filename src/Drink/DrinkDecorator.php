<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Enum\DrinkEnum;

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
