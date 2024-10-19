<?php

// Étape 5 : Implémentation des décorateurs pour le sucre et le lait
// 5.1 Classe Drink

/*
 * Toutes les boissons vont hériter de cette classe.
 * Elle définira la structure commune des boissons.
*/

abstract class Drink {
    protected $description = "Boisson inconnue";

    public function getDescription(): string {
        return $this->description;
    }

    abstract public function getPrice(): int;
}
