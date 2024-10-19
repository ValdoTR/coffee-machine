<?php

require 'vendor/autoload.php';

use App\CoffeeMachine;
use App\DrinkChoiceState;

$coffeeMachine = new CoffeeMachine(new DrinkChoiceState);
var_dump("isDrinkChoice");
var_dump($coffeeMachine->isDrinkChoice());

$coffeeMachine->selectDrink();
var_dump("isOptionsChoice");
var_dump($coffeeMachine->isOptionsChoice());

$coffeeMachine->dispenseDrink();
var_dump("isPayment");
var_dump($coffeeMachine->isPayment());

$coffeeMachine->insertCoin();
var_dump("isDispense");
var_dump($coffeeMachine->isDispense());

$coffeeMachine->start();
var_dump("isDrinkChoice");
var_dump($coffeeMachine->isDrinkChoice());