<?php declare(strict_types=1);

// Step 1

namespace App;

interface CoffeeMachineState
{
    public function selectDrink();
    public function selectSugar();
    public function selectMilk();
    public function dispenseDrink();
    public function insertCoin();
    public function start();
    public function cancel();
}
