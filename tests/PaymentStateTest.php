<?php

use PHPUnit\Framework\TestCase;
use App\CoffeeMachine;
use App\Drink\Tea;
use App\State\DispenseState;
use App\State\IllegalStateTransitionException;
use App\State\PaymentState;

class PaymentStateTest extends TestCase
{
    private CoffeeMachine $coffeeMachine;

    protected function setUp(): void
    {
        $drinkObject = new Tea();
        $this->coffeeMachine = new CoffeeMachine(new PaymentState($drinkObject));
    }

    public function testValidStateTransition(): void
    {
        $this->assertInstanceOf(PaymentState::class, $this->coffeeMachine->getState());
        $this->coffeeMachine->insertCoin(5);
        $this->assertInstanceOf(DispenseState::class, $this->coffeeMachine->getState());
    }

    public function testInvalidStateTransition(): void
    {
        $this->expectException(IllegalStateTransitionException::class);
        $this->coffeeMachine->selectSugar(1);
    }

    public function testInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->coffeeMachine->insertCoin(0);
    }
}
