<?php declare(strict_types=1);

use App\CoffeeMachine;
use App\CoffeeMachineState;

$coffeeMachine = new CoffeeMachine(new CoffeeMachineState);
var_dump($coffeeMachine->isDrinkChoice());

$coffeeMachine->selectDrink();
var_dump($coffeeMachine->isOptionsChoice());

$coffeeMachine->dispenseDrink();
var_dump($coffeeMachine->isPayment());

$coffeeMachine->insertCoin();
var_dump($coffeeMachine->isDispense());

$coffeeMachine->start();
var_dump($coffeeMachine->isDrinkChoice());