<?php declare(strict_types=1);

namespace App\Tests;

use App\CoffeeMachine;
use App\State\DrinkChoiceState;
use PHPUnit\Framework\TestCase;

final class CoffeeMachineTest extends TestCase
{
    private CoffeeMachine $coffeeMachine;

    protected function setUp(): void
    {
        $this->coffeeMachine = new CoffeeMachine(new DrinkChoiceState);
    }

    public function testIsDrinkChoice(): void
    {
        $this->assertTrue($this->coffeeMachine->isDrinkChoice());
    }
}
