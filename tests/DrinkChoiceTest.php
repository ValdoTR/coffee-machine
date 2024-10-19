<?php declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\CoffeeMachine;
use App\CoffeeMachineState;

class DrinkChoiceTest extends TestCase
{
    private CoffeeMachine $coffeeMachine;

    protected function setUp(): void
    {
        $this->coffeeMachine = new CoffeeMachine(new CoffeeMachineState);
    }

    public function testIsDrinkChoice(): void
    {
        $this->assertTrue($this->coffeeMachine->isDrinkChoice());
    }
}
