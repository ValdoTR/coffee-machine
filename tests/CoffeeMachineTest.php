<?php declare(strict_types=1);

namespace App\Tests;

use App\CoffeeMachine;
use App\Enum\DrinkEnum;
use App\State\DispenseState;
use App\State\DrinkChoiceState;
use App\State\OptionsChoiceState;
use App\State\PaymentState;
use PHPUnit\Framework\TestCase;

final class CoffeeMachineTest extends TestCase
{
    private CoffeeMachine $coffeeMachine;

    protected function setUp(): void
    {
        $this->coffeeMachine = new CoffeeMachine(new DrinkChoiceState);
    }

    public function testSelectCoffeeAdd(): void
    {
        $this->coffeeMachine->selectDrink(DrinkEnum::COFFEE);
        $this->assertInstanceOf(OptionsChoiceState::class, $this->coffeeMachine->getState());
    }
}
