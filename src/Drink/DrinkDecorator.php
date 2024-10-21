<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;
use App\Enum\DrinkEnum;

abstract class DrinkDecorator extends Drink
{
    protected Drink $drinkObject;

    public function __construct(Drink $drinkObject)
    {
        parent::__construct($drinkObject->getName(), $drinkObject->getPrice());
        $this->drinkObject = $drinkObject;
    }

    public function getName(): DrinkEnum
    {
        return $this->drinkObject->getName();
    }

    public function getPrice(): int
    {
        return $this->drinkObject->getPrice();
    }
}
