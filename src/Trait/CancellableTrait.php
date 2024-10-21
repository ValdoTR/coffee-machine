<?php declare(strict_types=1);

namespace App\Trait;

use App\State\DrinkChoiceState;
use App\Trait\CreditHandableTrait;
use App\Utility\Logger;

trait CancellableTrait
{
    use CreditHandableTrait;

    public function cancel(): DrinkChoiceState
    {
        // Give back current credit to the user
        $change = $this->returnChange();
        if ($change > 0) {
            Logger::echoFeedback("Transaction annulée. Vous récupérez $change pièces.");
        }

        // Transition back to DrinkChoice State
        return new DrinkChoiceState();
    }
}
