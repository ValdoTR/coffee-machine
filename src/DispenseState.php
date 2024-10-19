<?php

// Step 7

namespace App;

use App\AbstractCoffeeMachineState;
use App\DrinkChoiceState;

class DispenseState extends AbstractCoffeeMachineState
{
    public function start(): DrinkChoiceState
    {
        return new DrinkChoiceState;
    }

    public function cancel(): DrinkChoiceState
    {
        // give back current credit to the user
        return new DrinkChoiceState;
    }
}