<?php

require 'vendor/autoload.php';

use App\CoffeeMachine;
use App\Enum\DrinkEnum;
use App\State\DrinkChoiceState;

$coffeeMachine = new CoffeeMachine(new DrinkChoiceState);

$parameters = [
    'drink' => DrinkEnum::COFFEE,
    'sugarLevel' => 2,
    'milkLevel' => 1,
    'coins' => 4,
];
$coffeeMachine->testMachine(...$parameters);
