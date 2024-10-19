<?php declare(strict_types=1);

// Step 5

namespace App;

use App\AbstractCoffeeMachineState;
use App\DrinkChoiceState;
use App\PaymentState;

class OptionsChoiceState extends AbstractCoffeeMachineState
{
    public function selectSugar(): void
    {
        // validate range [0,4]
    }

    public function selectMilk(): void
    {
        // validate range [0,4]
    }

    public function dispense(): PaymentState
    {
        return new PaymentState;
    }

    public function cancel(): DrinkChoiceState
    {
        // give back current credit to the user
        return new DrinkChoiceState;
    }
}