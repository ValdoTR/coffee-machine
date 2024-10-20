<?php

// Step 3

namespace App;

use App\CoffeeMachineState;
use App\IllegalStateTransitionException;
use App\DrinkEnum;

abstract class AbstractCoffeeMachineState implements CoffeeMachineState
{
    use CreditHandlerTrait, CancellableTrait;

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectDrink(DrinkEnum $drink)
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectSugar(int $sugarLevel)
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectMilk(int $milkLevel)
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function dispenseDrink()
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function insertCoin(int $coins)
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function finish()
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function cancel()
    {
        throw new IllegalStateTransitionException();
    }
}
