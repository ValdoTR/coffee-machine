<?php

// Étape 5 : Implémentation des décorateurs pour le sucre et le lait
// 5.2 Classes des boissons : Coffee, Tea, Chocolate

/*
 * Les classes qui définissent les différentes boissons avec leur prix respectif.
*/

class Coffee extends Drink {
    public function __construct() {
        $this->description = "Café";
    }

    public function getPrice(): int {
        return 2; // Prix du café : 2 pièces
    }
}
