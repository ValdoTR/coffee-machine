<?php

// Étape 4 : Implémentation de l'état CustomizationState

/*
 * L'état CustomizationState permet de sélectionner librement
 * le niveau de sucre et de lait dans n'importe quel ordre !
 * 
 * Après la sélection du sucre ou du lait, l'utilisateur peut
 * demander la distribution de la boisson à tout moment.
 * 
 * Lorsque la boisson est prête à être délivrée, nous utilisons
 * le pattern Decorator pour ajouter du sucre et du lait dynamiquement.
*/

class CustomizationState implements State
{
    private $coffeeMachine;

    public function __construct(CoffeeMachine $coffeeMachine) {
        $this->coffeeMachine = $coffeeMachine;
    }

    public function insertMoney(int $coins): void {
        echo "Vous avez déjà inséré des pièces et sélectionné une boisson.\n";
    }

    public function selectDrink(string $drinkType): void {
        echo "Vous avez déjà sélectionné une boisson. Pour changer, redémarrez la machine.\n";
    }

    public function selectSugarLevel(int $level): void {
        if ($level < 0 || $level > 4) {
            echo "Le niveau de sucre doit être compris entre 0 et 4.\n";
            return;
        }
        $this->coffeeMachine->setSugarLevel($level);
        echo "Niveau de sucre sélectionné : {$level}\n";
    }

    public function selectMilkLevel(int $level): void {
        if ($level < 0 || $level > 4) {
            echo "Le niveau de lait doit être compris entre 0 et 4.\n";
            return;
        }
        $this->coffeeMachine->setMilkLevel($level);
        echo "Niveau de lait sélectionné : {$level}\n";
    }

    public function dispenseDrink(): void {
        $drink = $this->coffeeMachine->getDrink();
        if ($drink === null) {
            echo "Aucune boisson sélectionnée.\n";
            return;
        }
        
        // Ajouter sucre et lait à la boisson via des décorateurs (que nous implémenterons bientôt)
        $drink = new SugarDecorator($drink, $this->coffeeMachine->getSugarLevel());
        $drink = new MilkDecorator($drink, $this->coffeeMachine->getMilkLevel());

        // Délivrer la boisson
        echo "Votre " . $drink->getDescription() . " est prêt. Montant total restant : " . $this->coffeeMachine->getCurrentCoins() . " pièces.\n";
        $this->coffeeMachine->reset();
    }
}
