<?php

declare(strict_types=1);

namespace App;

use App\Enum\DrinkEnum;
use App\State\CoffeeMachineState;
use App\State\DrinkChoiceState;
use App\State\IllegalStateTransitionException;
use App\Utility\Logger;

final class CoffeeMachine
{
    private CoffeeMachineState $state;

    public function __construct(CoffeeMachineState $state)
    {
        $this->setState($state);
    }

    public function getState(): CoffeeMachineState
    {
        Logger::logDebug("CoffeeMachine - getState", get_class($this->state));
        return $this->state;
    }

    private function setState(CoffeeMachineState $state): void
    {
        $this->state = $state;
        Logger::logDebug("CoffeeMachine - setState", get_class($state));
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectDrink(DrinkEnum $drink): void
    {
        try {
            $this->setState($this->state->selectDrink($drink));
            Logger::logInfo(" CoffeeMachine - selectDrink", $drink->name);
        } catch (IllegalStateTransitionException $e) {
            Logger::logError("CoffeeMachine - error", $e->getMessage());
            Logger::echoFeedback("Une erreur est survenue. Impossible de sélectionner la boisson.");
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectSugar(int $sugarLevel): void
    {
        try {
            $this->state->selectSugar($sugarLevel);
            Logger::logInfo("CoffeeMachine - selectSugar", $sugarLevel);
        } catch (IllegalStateTransitionException $e) {
            Logger::logError("CoffeeMachine - error", $e->getMessage());
            Logger::echoFeedback("Une erreur est survenue. Impossible de sélectionner le sucre.");
        } catch (\InvalidArgumentException $e) {
            Logger::logError("CoffeeMachine - error", $e->getMessage());
            Logger::echoFeedback("Veuillez choisir un niveau de sucre entre 0 et 4.");
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectMilk(int $milkLevel): void
    {
        try {
            $this->state->selectMilk($milkLevel);
            Logger::logInfo("CoffeeMachine - selectMilk", $milkLevel);
        } catch (IllegalStateTransitionException $e) {
            Logger::logError("CoffeeMachine - error", $e->getMessage());
            Logger::echoFeedback("Veuillez choisir un niveau de lait entre 0 et 4.");
        } catch (\InvalidArgumentException $e) {
            Logger::logError("CoffeeMachine - error", $e->getMessage());
            Logger::echoFeedback("Veuillez choisir un niveau de lait entre 0 et 4.");
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function confirmDrink(): void
    {
        try {
            $this->setState($this->state->confirmDrink());
            Logger::logInfo("CoffeeMachine - confirmDrink");
        } catch (IllegalStateTransitionException $e) {
            Logger::logError("CoffeeMachine - error", $e->getMessage());
            Logger::echoFeedback("Une erreur est survenue. Impossible de servir la boisson.");
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function insertCoin(int $coins): void
    {
        try {
            $this->setState($this->state->insertCoin($coins));
            Logger::logInfo("CoffeeMachine - insertCoin", $coins);
        } catch (IllegalStateTransitionException $e) {
            Logger::logError("CoffeeMachine - error", $e->getMessage());
            Logger::echoFeedback("Une erreur est survenue. Impossible d'insérer la pièce.");
        } catch (\InvalidArgumentException $e) {
            Logger::logError("CoffeeMachine - error", $e->getMessage());
            Logger::echoFeedback("Veuillez entrer un nombre de pièces entre 1 et 9.");
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function finish(): void
    {
        try {
            $this->setState($this->state->finish());
            Logger::logInfo("CoffeeMachine - finish");
        } catch (IllegalStateTransitionException $e) {
            Logger::logError("CoffeeMachine - error", $e->getMessage());
            Logger::echoFeedback("Une erreur est survenue. Impossible de finaliser l'opération.");
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function cancel(): DrinkChoiceState
    {
        Logger::logInfo("CoffeeMachine - cancel");
        return $this->state->cancel();
        // IllegalStateTransitionException is not possible here
        // because cancel() is implemented in every State as CancellableTrait
    }

    // E2E test function
    public function testMachine(DrinkEnum $drink, int $sugarLevel, int $milkLevel, int $coins): void
    {
        $this->selectDrink($drink);
        $this->selectSugar($sugarLevel);
        $this->selectMilk($milkLevel);
        $this->confirmDrink();
        $this->insertCoin($coins);
    }
}
