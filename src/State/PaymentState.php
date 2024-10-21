<?php declare(strict_types=1);

namespace App\State;

use App\Drink\Drink;
use App\State\AbstractCoffeeMachineState;
use App\State\DispenseState;
use App\Utility\Logger;

final class PaymentState extends AbstractCoffeeMachineState
{
    public function __construct(private Drink $drinkObject)
    {
    }

    public function insertCoin(int $coins): DispenseState|PaymentState
    {
        if ($coins >= 1 && $coins <= 9) {
            // Add the inserted coins to the current credit
            $this->addCoins($coins);
            Logger::echoFeedback("Vous avez inséré $coins pièce" . ($coins > 1 ? 's' : ''). ". Crédit : " . $this->getCredit() . " pièce" . ($coins > 1 ? 's' : ''). ".");
        } else {
            throw new \InvalidArgumentException("Invalid argument: The number of coins must be an integer within the range [1, 9]. Received: $coins.");
        }

        // Check if the user has inserted enough money
        if ($this->getCredit() >= $this->drinkObject->getPrice()) {
            Logger::echoFeedback("Achat validé.");
            $this->chargeUser($this->drinkObject->getPrice());
            // Transition to Dispense State
            return new DispenseState($this->drinkObject);
        } else {
            Logger::echoFeedback("Crédit insuffisant. Un {$this->drinkObject->getName()->label()} coûte {$this->drinkObject->getPrice()} pièce" . ($coins > 1 ? 's' : ''). ".");
            return $this;
        }
    }
}