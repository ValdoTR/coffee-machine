<?php declare(strict_types=1);

namespace App\Drink;

use App\Drink\Drink;

abstract class DrinkDecorator extends Drink
{
    public function __construct(protected Drink $drinkObject)
    {
    }
}
