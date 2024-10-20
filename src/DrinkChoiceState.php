<?php

// Step 4

namespace App;

use App\AbstractCoffeeMachineState;
use App\OptionsChoiceState;
use App\DrinkEnum;
use App\Coffee;
use App\Tea;
use App\Chocolate;

class DrinkChoiceState extends AbstractCoffeeMachineState
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
