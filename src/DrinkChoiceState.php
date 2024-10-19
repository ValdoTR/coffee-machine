<?php declare(strict_types=1);

// Step 4

namespace App;

use App\AbstractCoffeeMachineState;
use App\OptionsChoiceState;

class DrinkChoiceState extends AbstractCoffeeMachineState
{
    public function selectDrink(): OptionsChoiceState
    {
        return new OptionsChoiceState;
    }

    public function cancel(): DrinkChoiceState
    {
        // give back current credit to the user
        return new DrinkChoiceState;
    }
}
