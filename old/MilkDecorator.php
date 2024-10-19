<?php

// Étape 5 : Implémentation des décorateurs pour le sucre et le lait
// 5.3 Décorateurs : SugarDecorator et MilkDecorator

/*
 * Ces décorateurs vont enrichir la boisson sélectionnée en y ajoutant du sucre et du lait.
 * Chaque décorateur ajoute des informations à la description et ajuste potentiellement
 * le prix (même si ici ce n'est pas nécessaire, mais ce serait possible avec ce pattern).
*/

class MilkDecorator extends Drink {
    private $drink;
    private $milkLevel;

    public function __construct(Drink $drink, int $milkLevel) {
        $this->drink = $drink;
        $this->milkLevel = $milkLevel;
    }

    public function getDescription(): string {
        return $this->drink->getDescription() . " avec {$this->milkLevel} lait(s)";
    }

    public function getPrice(): int {
        return $this->drink->getPrice(); // Pas de coût supplémentaire pour le lait
    }
}