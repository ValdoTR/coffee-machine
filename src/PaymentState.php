<?php declare(strict_types=1);

// Step 6

namespace App;

use App\AbstractCoffeeMachineState;
use App\DispenseState;
use App\DrinkChoiceState;

class PaymentState extends AbstractCoffeeMachineState
{
    public function insertCoin(): DispenseState
    {
        // check credit
        return new DispenseState;
    }

    public function cancel(): DrinkChoiceState
    {
        // give back current credit to the user
        return new DrinkChoiceState;
    }
}