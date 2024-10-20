<?php declare(strict_types=1);

namespace App\Enum;

enum DrinkEnum: int {
    case COFFEE = 1;
    case TEA = 2;
    case CHOCOLATE = 3;

    public function label() {
        return match ($this) {
            self::COFFEE => 'Café',
            self::TEA => 'Thé',
            self::CHOCOLATE => 'Chocolat',
        };
    }
}
