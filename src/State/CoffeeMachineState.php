<?php declare(strict_types=1);

namespace App\State;

use App\Enum\DrinkEnum;

interface CoffeeMachineState
{
    public function selectDrink(DrinkEnum $drink);
    public function selectSugar(int $sugarLevel);
    public function selectMilk(int $milkLevel);
    public function confirmDrink();
    public function insertCoin(int $coins);
    public function finish();
    public function cancel();
}
