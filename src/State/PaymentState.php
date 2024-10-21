<?php declare(strict_types=1);

namespace App\State;

use App\Drink\Drink;
use App\State\AbstractCoffeeMachineState;
use App\State\DispenseState;

final class PaymentState extends AbstractCoffeeMachineState
{
    public function __construct(private Drink $drinkObject)
    {
    }

    public function insertCoin(int $coins): DispenseState|PaymentState
    {
        if ($coins >= 1 && $coins <= 9) {
            // Add the inserted coins to the current credit
            $this->addCredit($coins);
            echo "Vous avez inséré $coins pièce" . ($coins > 1 ? 's' : ''). ". Crédit : " . $this->getCredit() . " pièce" . ($coins > 1 ? 's' : ''). ".\n";
        } else {
            throw new \InvalidArgumentException("Invalid argument: The number of coins must be an integer within the range [1, 9]. Received: $coins.\n");
        }

        // Check if the user has inserted enough money
        if ($this->getCredit() >= $this->drinkObject->getPrice()) {
            echo "Achat de votre " . $this->drinkObject->getName()->label() . " validé.\n";
            // Transition to Dispense State
            return new DispenseState($this->drinkObject);
        } else {
            echo "Crédit insuffisant. Un {$this->drinkObject->getName()->label()} coûte {$this->drinkObject->getPrice()} pièce" . ($coins > 1 ? 's' : ''). ".\n";
            return $this;
        }
    }
}