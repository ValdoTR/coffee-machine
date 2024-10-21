<?php declare(strict_types=1);

namespace App\State;

use App\Enum\DrinkEnum;
use App\State\CoffeeMachineState;
use App\State\IllegalStateTransitionException;
use App\Trait\CreditHandableTrait;
use App\Trait\CancellableTrait;

abstract class AbstractCoffeeMachineState implements CoffeeMachineState
{
    use CreditHandableTrait, CancellableTrait;

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
    public function confirmDrink()
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
