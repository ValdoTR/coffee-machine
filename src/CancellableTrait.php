<?php

namespace App;

use App\DrinkChoiceState;

trait CancellableTrait
{
    use CreditHandlerTrait;

    public function cancel(): DrinkChoiceState
    {
        // Give back current credit to the user
        $change = $this->returnChange();
        if ($change > 0) {
            echo "Transaction annulée. Vous récupérez $change pièces.\n";
        }

        // Transition back to DrinkChoice State
        return new DrinkChoiceState();
    }
}
