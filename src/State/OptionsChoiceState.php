<?php declare(strict_types=1);

namespace App\State;

use App\Drink\Drink;
use App\Drink\SugarDecorator;
use App\Drink\MilkDecorator;
use App\State\AbstractCoffeeMachineState;
use App\State\PaymentState;
use App\Utility\Logger;

final class OptionsChoiceState extends AbstractCoffeeMachineState
{
    public function __construct(private Drink $drinkObject)
    {
    }

    public function selectSugar(int $sugarLevel): void
    {
        if ($sugarLevel >= 0 && $sugarLevel <= 4) {
            $this->drinkObject = new SugarDecorator($this->drinkObject, $sugarLevel);
            Logger::echoFeedback("Niveau de sucre sélectionné: $sugarLevel");
        } else {
            throw new \InvalidArgumentException("Invalid argument: The sugar level must be an integer within the range [0, 4]. Received: $sugarLevel.");
        }
    }

    public function selectMilk(int $milkLevel): void
    {
        if ($milkLevel >= 0 && $milkLevel <= 4) {
            $this->drinkObject = new MilkDecorator($this->drinkObject, $milkLevel);
            Logger::echoFeedback("Niveau de lait sélectionné: $milkLevel");
        } else {
            throw new \InvalidArgumentException("Invalid argument: The milk level must be an integer within the range [0, 4]. Received: $milkLevel.");
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
        Logger::echoFeedback("Vous avez choisi un " . $this->drinkObject->getName()->label() . $sugarMessage . " et " . $milkMessage . ".");

        Logger::echoFeedback("Prix : " . $this->drinkObject->getPrice() . " pièces.");

        // Transition to Payment State
        return new PaymentState($this->drinkObject);
    }
}