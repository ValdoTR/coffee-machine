<?php

// Étape 3 : Implémentation de l'état DrinkSelectionState

/*
 * L'état DrinkSelectionState permet à l'utilisateur de choisir une boisson,
 * en vérifiant que la somme insérée est suffisante.
 * 
 * La méthode selectDrink crée une instance de la boisson choisie en utilisant
 * une méthode de la machine appelée createDrink.
 * 
 * Si l'argent est suffisant, la machine permet à l'utilisateur de passer à
 * l'étape de sélection du sucre OU du lait grâce à CustomizationState.
*/

class DrinkSelectionState implements State
{
    private $coffeeMachine;

    public function __construct(CoffeeMachine $coffeeMachine) {
        $this->coffeeMachine = $coffeeMachine;
    }

    public function insertMoney(int $coins): void {
        echo "Vous avez déjà inséré des pièces. Veuillez sélectionner une boisson.\n";
    }

    public function selectDrink(string $drinkType): void {
        $drink = $this->coffeeMachine->createDrink($drinkType);
        if ($drink === null) {
            echo "Boisson non disponible.\n";
            return;
        }

        if ($this->coffeeMachine->getCurrentCoins() >= $drink->getPrice()) {
            echo "Vous avez sélectionné un {$drinkType}. Prix : " . $drink->getPrice() . " pièces.\n";
            $this->coffeeMachine->setDrink($drink);
            $this->coffeeMachine->setState($this->coffeeMachine->getCustomizationState());
        } else {
            echo "Fonds insuffisants. Veuillez insérer plus d'argent.\n";
        }
    }

    public function selectSugarLevel(int $level): void {
        echo "Veuillez sélectionner une boisson avant de choisir le niveau de sucre.\n";
    }

    public function selectMilkLevel(int $level): void {
        echo "Veuillez sélectionner une boisson avant de choisir le niveau de lait.\n";
    }

    public function dispenseDrink(): void {
        echo "Veuillez d'abord sélectionner une boisson avant de distribuer.\n";
    }
}
