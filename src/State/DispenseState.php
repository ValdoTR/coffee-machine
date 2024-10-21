<?php declare(strict_types=1);

namespace App\State;

use App\Drink\Drink;
use App\Drink\MilkDecorator;
use App\Drink\SugarDecorator;
use App\State\AbstractCoffeeMachineState;
use App\State\DrinkChoiceState;

class DispenseState extends AbstractCoffeeMachineState
{
    private Drink $drinkObject;

    public function __construct(Drink $drinkObject)
    {
        $this->drinkObject = $drinkObject;
        // We call finish() right away because we already validated payment
        $this->finish();
    }

    public function finish(): DrinkChoiceState
    {
        // Check for sugar and milk levels
        $sugarLevel = ($this->drinkObject instanceof SugarDecorator) ? $this->drinkObject->getSugarLevel() : 0;
        $milkLevel = ($this->drinkObject instanceof MilkDecorator) ? $this->drinkObject->getMilkLevel() : 0;

        // Create messages based on sugar and milk levels
        $sugarMessage = ($sugarLevel > 0) ? " avec $sugarLevel sucre" . ($sugarLevel > 1 ? 's' : '') : " sans sucre";
        $milkMessage = ($milkLevel > 0) ? "avec $milkLevel lait" . ($milkLevel > 1 ? 's' : '') : "sans lait";

        // Print out the full message
        echo $this->drinkObject->getName()->label() . $sugarMessage . " et " . $milkMessage . " en cours de préparation...\n";

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
