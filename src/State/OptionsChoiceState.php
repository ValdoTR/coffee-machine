<?php declare(strict_types=1);

namespace App\State;

use App\Drink\Drink;
use App\Drink\SugarDecorator;
use App\Drink\MilkDecorator;
use App\State\AbstractCoffeeMachineState;
use App\State\PaymentState;

final class OptionsChoiceState extends AbstractCoffeeMachineState
{
    public function __construct(private Drink $drinkObject)
    {
    }

    public function selectSugar(int $sugarLevel): self
    {
        if ($sugarLevel >= 0 && $sugarLevel <= 4) {
            $this->drinkObject = new SugarDecorator($this->drinkObject, $sugarLevel);
            echo "Niveau de sucre sélectionné: $sugarLevel\n";
            // Return the current instance as we don't want to transition
            return $this;
        } else {
            throw new \InvalidArgumentException("Invalid argument: The sugar level must be an integer within the range [0, 4]. Received: $sugarLevel.\n");
        }
    }

    public function selectMilk(int $milkLevel): self
    {
        if ($milkLevel >= 0 && $milkLevel <= 4) {
            $this->drinkObject = new MilkDecorator($this->drinkObject, $milkLevel);
            echo "Niveau de lait sélectionné: $milkLevel\n";
            // Return the current instance as we don't want to transition
            return $this;
        } else {
            throw new \InvalidArgumentException("Invalid argument: The milk level must be an integer within the range [0, 4]. Received: $milkLevel.\n");
        }
    }

    public function confirmDrink(): PaymentState
    {
        // Check for sugar and milk levels
        $sugarLevel = ($this->drinkObject instanceof SugarDecorator) ? $this->drinkObject->getSugarLevel() : 0;
        $milkLevel = ($this->drinkObject instanceof MilkDecorator) ? $this->drinkObject->getMilkLevel() : 0;
        
        // Create messages based on sugar and milk levels
        $sugarMessage = ($sugarLevel > 0) ? " avec $sugarLevel sucre" . ($sugarLevel > 1 ? 's' : '') : " sans sucre";
        $milkMessage = ($milkLevel > 0) ? "avec $milkLevel lait" . ($milkLevel > 1 ? 's' : '') : "sans lait";

        // Print out the full message
        echo "Vous avez choisi un " . $this->drinkObject->getName()->label() . $sugarMessage . " et " . $milkMessage . ".\n";

        echo "Prix total: " . $this->drinkObject->getPrice() . " pièces.\n";

        // Transition to Payment State
        return new PaymentState($this->drinkObject);
    }
}