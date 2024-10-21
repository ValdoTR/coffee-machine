<?php declare(strict_types=1);

namespace App\State;

use App\Drink\Drink;
use App\State\AbstractCoffeeMachineState;
use App\State\DrinkChoiceState;
use App\Utility\Logger;

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
        Logger::echoFeedback("Bonne dégustation de votre " . $this->drinkObject->getName()->label() . " !");

        // Give back current credit to the user
        $change = $this->returnChange();
        if ($change > 0) {
            Logger::echoFeedback("Vous récupérez $change pièces.");
        }
        
        // Transition back to DrinkChoice State
        // for the next transaction
        return new DrinkChoiceState();
    }
}
