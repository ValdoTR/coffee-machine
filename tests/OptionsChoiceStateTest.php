<?php

use PHPUnit\Framework\TestCase;
use App\CoffeeMachine;
use App\Drink\Coffee;
use App\State\IllegalStateTransitionException;
use App\State\OptionsChoiceState;
use App\State\PaymentState;

class OptionsChoiceStateTest extends TestCase
{
    private CoffeeMachine $coffeeMachine;

    protected function setUp(): void
    {
        $drinkObject = new Coffee();
        $this->coffeeMachine = new CoffeeMachine(new OptionsChoiceState($drinkObject));
    }

    public function testValidStateTransition(): void
    {
        $this->assertInstanceOf(OptionsChoiceState::class, $this->coffeeMachine->getState());
        $this->coffeeMachine->selectSugar(3);
        $this->coffeeMachine->selectSugar(1);
        $this->assertInstanceOf(OptionsChoiceState::class, $this->coffeeMachine->getState());
        $this->coffeeMachine->confirmDrink();
        $this->assertInstanceOf(PaymentState::class, $this->coffeeMachine->getState());
    }

    public function testInvalidStateTransition(): void
    {
        $this->expectException(IllegalStateTransitionException::class);
        $this->coffeeMachine->finish();
    }

    public function testInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->coffeeMachine->selectSugar(99);
    }
}
