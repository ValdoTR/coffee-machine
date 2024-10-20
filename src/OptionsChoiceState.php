<?php

// Step 5

namespace App;

use App\AbstractCoffeeMachineState;
use App\Drink;
use App\SugarDecorator;
use App\MilkDecorator;
use App\PaymentState;

class OptionsChoiceState extends AbstractCoffeeMachineState
{
    private Drink $drink;

    public function __construct(Drink $drink)
    {
        $this->drink = $drink;
    }

    public function selectSugar(int $sugarLevel): void
    {
        if ($sugarLevel < 0 || $sugarLevel > 4) {
            echo "Niveau de sucre invalide. Veuillez sélectionner un niveau entre 0 et 4.\n";
        } else {
            $this->drink = new SugarDecorator($this->drink, $sugarLevel);
            echo "Niveau de sucre sélectionné: $sugarLevel\n";
        }
    }

    public function selectMilk(int $milkLevel): void
    {
        if ($milkLevel < 0 || $milkLevel > 4) {
            echo "Niveau de lait invalide. Veuillez sélectionner un niveau entre 0 et 4.\n";
        } else {
            $this->drink = new MilkDecorator($this->drink, $milkLevel);
            echo "Niveau de lait sélectionné: $milkLevel\n";
        }
    }

    public function dispenseDrink(): PaymentState
    {
        // Display the final drink with sugar and milk
        echo "Vous avez choisi " . $this->drink->getName()->label() . "\n";
        echo "Prix total: " . $this->drink->getPrice() . " pièces.\n";

        // Transition to Payment State
        return new PaymentState($this->drink);
    }
}