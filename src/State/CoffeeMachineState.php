<?php declare(strict_types=1);

namespace App\State;

use App\Enum\DrinkEnum;

interface CoffeeMachineState
{
    public function selectDrink(DrinkEnum $drink): OptionsChoiceState;
    public function selectSugar(int $sugarLevel): OptionsChoiceState;
    public function selectMilk(int $milkLevel): OptionsChoiceState;
    public function confirmDrink(): PaymentState;
    public function insertCoin(int $coins): DispenseState|PaymentState;
    public function finish(): DrinkChoiceState;
    public function cancel(): DrinkChoiceState;
}
