<?php

declare(strict_types=1);

namespace App\State;

use App\Enum\DrinkEnum;
use App\State\CoffeeMachineState;
use App\State\IllegalStateTransitionException;
use App\Trait\CreditHandableTrait;
use App\Trait\CancellableTrait;

abstract class AbstractCoffeeMachineState implements CoffeeMachineState
{
    use CreditHandableTrait;
    use CancellableTrait;

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectDrink(DrinkEnum $drink): OptionsChoiceState
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectSugar(int $sugarLevel): void
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectMilk(int $milkLevel): void
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function confirmDrink(): PaymentState
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function insertCoin(int $coins): DispenseState|PaymentState
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function finish(): DrinkChoiceState
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function cancel(): DrinkChoiceState
    {
        throw new IllegalStateTransitionException();
    }
}
