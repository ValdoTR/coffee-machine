<?php

namespace App;

use App\DrinkEnum;

interface CoffeeMachineState
{
    public function selectDrink(DrinkEnum $drink);
    public function selectSugar(int $sugarLevel);
    public function selectMilk(int $milkLevel);
    public function dispenseDrink();
    public function insertCoin(int $coins);
    public function finish();
    public function cancel();
}
