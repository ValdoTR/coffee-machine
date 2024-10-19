<?php declare(strict_types=1);

// Step 3

namespace App;

use App\CoffeeMachineState;
use App\IllegalStateTransitionException;

abstract class AbstractCoffeeMachineState implements CoffeeMachineState
{
    /**
     * @throws IllegalStateTransitionException
     */
    public function selectDrink()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectSugar()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectMilk()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function dispenseDrink()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function insertCoin()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function start()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function cancel()
    {
        throw new IllegalStateTransitionException;
    }
}
