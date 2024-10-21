<?php

use PHPUnit\Framework\TestCase;
use App\CoffeeMachine;
use App\State\DrinkChoiceState;
use App\Enum\DrinkEnum;
use App\State\IllegalStateTransitionException;
use App\State\OptionsChoiceState;

class DrinkChoiceStateTest extends TestCase
{
    private CoffeeMachine $coffeeMachine;

    protected function setUp(): void
    {
        $this->coffeeMachine = new CoffeeMachine(new DrinkChoiceState());
    }

    public function testValidStateTransition(): void
    {
        $this->assertInstanceOf(DrinkChoiceState::class, $this->coffeeMachine->getState());
        $this->coffeeMachine->selectDrink(DrinkEnum::COFFEE);
        $this->assertInstanceOf(OptionsChoiceState::class, $this->coffeeMachine->getState());
    }

    public function testInvalidStateTransition(): void
    {
        $this->expectException(IllegalStateTransitionException::class);
        $this->coffeeMachine->confirmDrink();
    }
}
