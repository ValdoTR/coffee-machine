<?php

// Étape 1 : Définir l'interface State

/**
 * Cette interface garantit que chaque état aura ces méthodes.
 * Chaque état de la machine (ReadyState, DrinkSelectionState, etc)
 * devra les implémenter selon le contexte de cet état.
*/
interface State
{
    public function insertMoney(int $coins): void;
    public function selectDrink(string $drinkType): void;
    public function selectSugarLevel(int $level): void;
    public function selectMilkLevel(int $level): void;
    public function dispenseDrink(): void;
}
