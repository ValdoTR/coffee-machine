<?php declare(strict_types=1);

namespace App\State;

use App\Drink\Drink;
use App\State\AbstractCoffeeMachineState;
use App\State\DrinkChoiceState;

class DispenseState extends AbstractCoffeeMachineState
{
    private Drink $drink;

    public function __construct(Drink $drink)
    {
        $this->drink = $drink;
    }

    public function finish(): DrinkChoiceState
    {
        // Simulate dispensing the drink
        echo "Votre " . $this->drink->getName()->label() . " est en cours de préparation...\n";
        
        for ($i = 0; $i < 3; $i++) {
            sleep(1); // Wait for 1 second
            echo ".\n"; // Print a drop
        }

        echo "Bonne dégustation !\n";

        // Give back current credit to the user
        $change = $this->returnChange();
        if ($change > 0) {
            echo "Vous récupérez $change pièces.\n";
        }
        
        // Transition back to DrinkChoice State
        // for the next transaction
        return new DrinkChoiceState();
    }
}
