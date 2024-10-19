<?php

// Étape 2 : Implémentation de l'état ReadyState

/**
 * ReadyState représente l'état où la machine attend que l'utilisateur insère des pièces.
 * 
 * Si l'utilisateur essaie de sélectionner une boisson, du sucre ou du lait sans avoir inséré d'argent,
 * la machine affiche un message d'erreur.
 * 
 * Une fois que l'argent est inséré, la machine change d'état et passe à DrinkSelectionState.
*/
abstract class ReadyState implements State
{
    private $coffeeMachine;

    public function __construct(CoffeeMachine $coffeeMachine) {
        $this->coffeeMachine = $coffeeMachine;
    }

    public function insertMoney(int $coins): void {
        // Ajouter l'argent à la machine
        $this->coffeeMachine->addMoney($coins);
        echo "Crédit : " . $this->coffeeMachine->getCurrentCoins() . " pièces.\n";
        // Changer l'état pour l'état de sélection de boisson
        $this->coffeeMachine->setState($this->coffeeMachine->getDrinkSelectionState());
    }

    public function selectDrink(string $drinkType): void {
        echo "Veuillez d'abord insérer des pièces avant de sélectionner une boisson.\n";
    }

    public function selectSugarLevel(int $level): void {
        echo "Veuillez d'abord insérer des pièces avant de sélectionner le niveau de sucre.\n";
    }

    public function selectMilkLevel(int $level): void {
        echo "Veuillez d'abord insérer des pièces avant de sélectionner le niveau de lait.\n";
    }

    public function dispenseDrink(): void {
        echo "Vous devez d'abord sélectionner une boisson et payer avant de recevoir une boisson.\n";
    }
}
