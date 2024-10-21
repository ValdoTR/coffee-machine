<?php declare(strict_types=1);

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
        Logger::logDebug("getState", get_class($this->state));
        return $this->state;
    }

    private function setState(CoffeeMachineState $state): void
    {
        $this->state = $state;
        Logger::logDebug("setState", get_class($state));
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectDrink(DrinkEnum $drink): void
    {
        try {
            $this->setState($this->state->selectDrink($drink));
            Logger::logInfo("selectDrink", $drink->name);
        } catch (IllegalStateTransitionException $e) {
            Logger::logError($e->getMessage());
            echo "Une erreur est survenue. Impossible de sélectionner la boisson.\n";
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectSugar(int $sugarLevel): void
    {
        try {
            $this->setState($this->state->selectSugar($sugarLevel));
            Logger::logInfo("selectSugar", $sugarLevel);
        } catch (IllegalStateTransitionException $e) {
            Logger::logError($e->getMessage());
            echo "Une erreur est survenue. Impossible de sélectionner le sucre.\n";
        } catch (\InvalidArgumentException $e) {
            Logger::logError($e->getMessage());
            echo "Veuillez choisir un niveau de sucre entre 0 et 4.\n";
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function selectMilk(int $milkLevel): void
    {
        try {
            $this->setState($this->state->selectMilk($milkLevel));
            Logger::logInfo("selectMilk", $milkLevel);
        } catch (IllegalStateTransitionException $e) {
            Logger::logError($e->getMessage());
            echo "Veuillez choisir un niveau de lait entre 0 et 4.\n";
        } catch (\InvalidArgumentException $e) {
            Logger::logError($e->getMessage());
            echo "Veuillez choisir un niveau de lait entre 0 et 4.\n";
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function confirmDrink(): void
    {
        try {
            $this->setState($this->state->confirmDrink());
            Logger::logInfo("confirmDrink");
        } catch (IllegalStateTransitionException $e) {
            Logger::logError($e->getMessage());
            echo "Une erreur est survenue. Impossible de servir la boisson.\n";
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function insertCoin(int $coins): void
    {
        try {
            $this->setState($this->state->insertCoin($coins));
            Logger::logInfo("insertCoin", $coins);
        } catch (IllegalStateTransitionException $e) {
            Logger::logError($e->getMessage());
            echo "Une erreur est survenue. Impossible d'insérer la pièce.\n";
        } catch (\InvalidArgumentException $e) {
            Logger::logError($e->getMessage());
            echo "Veuillez entrer un nombre de pièces entre 1 et 9.\n";
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function finish(): void
    {
        try {
            $this->setState($this->state->finish());
            Logger::logInfo("finish");
        } catch (IllegalStateTransitionException $e) {
            Logger::logError($e->getMessage());
            echo "Une erreur est survenue. Impossible de finaliser l'opération.\n";
        }
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function cancel(): DrinkChoiceState
    {
        Logger::logInfo("cancel");
        return $this->state->cancel();
        // IllegalStateTransitionException is not possible here
        // because cancel() is implemented in every State as CancellableTrait
    }

    // E2E test function
    public function testMachine(DrinkEnum $drink, int $sugarLevel, int $milkLevel, int $coins): void 
    {
        // Select a drink
        $this->selectDrink($drink);

        // Select sugar
        $this->selectSugar($sugarLevel);

        // Select milk
        $this->selectMilk($milkLevel);

        // Confirm the drink
        $this->confirmDrink();

        // Insert coins
        $this->insertCoin($coins);
    }
}