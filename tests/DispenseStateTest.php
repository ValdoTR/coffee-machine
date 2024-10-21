<?php

use PHPUnit\Framework\TestCase;
use App\CoffeeMachine;
use App\Drink\Chocolate;
use App\State\DispenseState;
use App\State\DrinkChoiceState;
use App\State\IllegalStateTransitionException;

class DispenseStateTest extends TestCase
{
    private CoffeeMachine $coffeeMachine;

    protected function setUp(): void
    {
        $drinkObject = new Chocolate();
        $this->coffeeMachine = new CoffeeMachine(new DispenseState($drinkObject));
    }

    public function testValidStateTransition(): void
    {
        $this->assertInstanceOf(DispenseState::class, $this->coffeeMachine->getState());
        $this->coffeeMachine->finish();
        $this->assertInstanceOf(DrinkChoiceState::class, $this->coffeeMachine->getState());
    }

    public function testInvalidStateTransition(): void
    {
        $this->expectException(IllegalStateTransitionException::class);
        $this->coffeeMachine->selectSugar(1);
    }
}
