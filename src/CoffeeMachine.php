<?php declare(strict_types=1);

namespace App;

use App\Enum\DrinkEnum;
use App\State\CoffeeMachineState;
use App\State\IllegalStateTransitionException;
use App\State\DrinkChoiceState;
use App\State\OptionsChoiceState;
use App\State\PaymentState;
use App\State\DispenseState;

final class CoffeeMachine
{
    private CoffeeMachineState $state;

    public function __construct(CoffeeMachineState $state)
    {
        $this->setState($state);
    }

    private function setState(CoffeeMachineState $state)
    {
        $this->state = $state;
        error_log("-> State transition ->");
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectDrink(DrinkEnum $drink)
    {
        $this->setState($this->state->selectDrink($drink));
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectSugar(int $sugarLevel)
    {
        $this->setState($this->state->selectSugar($sugarLevel));
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectMilk(int $milkLevel)
    {
        $this->setState($this->state->selectMilk($milkLevel));
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
    public function insertCoin(int $coins)
    {
        $this->setState($this->state->insertCoin($coins));
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function finish()
    {
        $this->setState($this->state->finish());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function cancel(): DrinkChoiceState
    {
        return $this->state->cancel();
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