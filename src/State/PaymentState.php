<?php declare(strict_types=1);

namespace App\State;

use App\Drink\Drink;
use App\State\AbstractCoffeeMachineState;
use App\State\DispenseState;

final class PaymentState extends AbstractCoffeeMachineState
{
    private Drink $drink;

    public function __construct(Drink $drink)
    {
        $this->drink = $drink;
    }

    public function insertCoin(int $coins): DispenseState
    {
        // Add the inserted coins to the current credit
        $this->addCredit($coins);
        echo "Vous avez inséré $coins pièces. Crédit total: " . $this->getCredit() . " pièces.\n";

        // Check if the user has inserted enough money
        if ($this->getCredit() >= $this->drink->getPrice()) {
            echo "Crédit suffisant pour " . $this->drink->getName()->label() . ".\n";
            // Transition to Dispense State
            return new DispenseState($this->drink);
        } else {
            echo "Crédit insuffisant. Veuillez insérer plus de pièces.\n";
            return $this;
        }
    }
}