<?php declare(strict_types=1);

// Step 8

namespace App;

use App\CoffeeMachineState;
use App\IllegalStateTransitionException;
use App\DrinkChoiceState;
use App\OptionsChoiceState;
use App\PaymentState;
use App\DispenseState;

class CoffeeMachine
{
    private CoffeeMachineState $state;

    public function __construct(CoffeeMachineState $state)
    {
        $this->setState($state);
    }

    private function setState(CoffeeMachineState $state)
    {
        $this->state = $state;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectDrink()
    {
        $this->setState($this->state->selectDrink());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectSugar()
    {
        $this->setState($this->state->selectSugar());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectMilk()
    {
        $this->setState($this->state->selectMilk());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function dispenseDrink()
    {
        $this->setState($this->state->dispenseDrink());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function insertCoin()
    {
        $this->setState($this->state->insertCoin());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function start()
    {
        $this->setState($this->state->start());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function cancel()
    {
        $this->setState($this->state->cancel());
    }

    /* Helper functions */

    /**
     * @return bool
     */
    public function isDrinkChoice()
    {
        return $this->state instanceof DrinkChoiceState;
    }

    /**
     * @return bool
     */
    public function isOptionsChoice()
    {
        return $this->state instanceof OptionsChoiceState;
    }

    /**
     * @return bool
     */
    public function isPayment()
    {
        return $this->state instanceof PaymentState;
    }

    /**
     * @return bool
     */
    public function isDispense()
    {
        return $this->state instanceof DispenseState;
    }
}