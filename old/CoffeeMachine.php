<?php

// Étape 6 : Implémentation de la classe principale CoffeeMachine

/*
 * États internes :
 * La machine possède trois états principaux : ReadyState, DrinkSelectionState, et CustomizationState.
 * Ces états sont instanciés lors de la création de la machine.
 * 
 * Changement d'état :
 * La méthode setState permet de basculer d'un état à un autre en fonction des actions de l'utilisateur.
 * 
 * Gestion des boissons :
 * La méthode createDrink est responsable de créer des instances de boissons selon la sélection de l'utilisateur.
 * 
 * Niveaux de sucre et de lait :
 * La machine enregistre les niveaux de sucre et de lait choisis par l'utilisateur pour personnaliser
 * la boisson à l'aide des décorateurs.
 * 
 * Interactions utilisateur :
 * L'utilisateur interagit avec la machine via les méthodes
 * insertMoney, selectDrink, selectSugarLevel, selectMilkLevel, et dispenseDrink,
 * qui dépendent de l'état actuel de la machine.
*/

class CoffeeMachine
{
    private $readyState;
    private $drinkSelectionState;
    private $customizationState;
    
    private $currentState;

    private $currentCoins = 0;
    private $selectedDrink = null;
    private $sugarLevel = 0;
    private $milkLevel = 0;

    public function __construct() {
        // Initialiser les états de la machine
        $this->readyState = new ReadyState($this);
        $this->drinkSelectionState = new DrinkSelectionState($this);
        $this->customizationState = new CustomizationState($this);

        // L'état initial est "prêt à recevoir des pièces"
        $this->currentState = $this->readyState;
    }

    // Méthodes pour changer d'état
    public function setState(State $state) {
        $this->currentState = $state;
    }

    public function getReadyState(): State {
        return $this->readyState;
    }

    public function getDrinkSelectionState(): State {
        return $this->drinkSelectionState;
    }

    public function getCustomizationState(): State {
        return $this->customizationState;
    }

    // Gestion des pièces
    public function addMoney(int $coins) {
        $this->currentCoins += $coins;
    }

    public function getCurrentCoins(): int {
        return $this->currentCoins;
    }

    public function reset() {
        $this->currentCoins = 0;
        $this->selectedDrink = null;
        $this->sugarLevel = 0;
        $this->milkLevel = 0;
        $this->currentState = $this->readyState;
    }

    // Gestion des boissons
    public function createDrink(string $drinkType): ?Drink {
        switch ($drinkType) {
            case 'coffee':
                return new Coffee();
            case 'tea':
                return new Tea();
            case 'chocolate':
                return new Chocolate();
            default:
                return null;
        }
    }

    public function setDrink(Drink $drink) {
        $this->selectedDrink = $drink;
    }

    public function getDrink(): ?Drink {
        return $this->selectedDrink;
    }

    // Sucre et lait
    public function setSugarLevel(int $level) {
        $this->sugarLevel = $level;
    }

    public function getSugarLevel(): int {
        return $this->sugarLevel;
    }

    public function setMilkLevel(int $level) {
        $this->milkLevel = $level;
    }

    public function getMilkLevel(): int {
        return $this->milkLevel;
    }

    // Méthodes pour interagir avec la machine via les différents états
    public function insertMoney(int $coins) {
        $this->currentState->insertMoney($coins);
    }

    public function selectDrink(string $drinkType) {
        $this->currentState->selectDrink($drinkType);
    }

    public function selectSugarLevel(int $level) {
        $this->currentState->selectSugarLevel($level);
    }

    public function selectMilkLevel(int $level) {
        $this->currentState->selectMilkLevel($level);
    }

    public function dispenseDrink() {
        $this->currentState->dispenseDrink();
    }
}