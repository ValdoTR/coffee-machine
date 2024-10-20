<?php declare(strict_types=1);

namespace App\State;

use App\Drink\Coffee;
use App\Drink\Tea;
use App\Drink\Chocolate;
use App\Enum\DrinkEnum;
use App\State\AbstractCoffeeMachineState;
use App\State\OptionsChoiceState;

final class DrinkChoiceState extends AbstractCoffeeMachineState
{
    public function selectDrink(DrinkEnum $drink): OptionsChoiceState
    {
        // Create the corresponding drink object
        $drinkObject = match ($drink) {
            DrinkEnum::COFFEE => new Coffee(),
            DrinkEnum::TEA => new Tea(),
            DrinkEnum::CHOCOLATE => new Chocolate(),
        };

        // Transition to OptionsChoice State
        return new OptionsChoiceState($drinkObject);
    }
}
