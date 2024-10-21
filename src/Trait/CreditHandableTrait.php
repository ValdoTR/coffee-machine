<?php declare(strict_types=1);

namespace App\Trait;

use App\Utility\Logger;

trait CreditHandableTrait
{
    protected static int $credit = 0;

    public function getCredit(): int
    {
        return self::$credit;
    }

    public function addCoins(int $coins): void
    {
        self::$credit += $coins;
        Logger::logDebug("CreditHandableTrait - Coins added: $coins. Total credit: " . self::$credit);
    }

    public function chargeUser(int $drinkPrice): void
    {
        self::$credit -= $drinkPrice;
        Logger::logDebug("CreditHandableTrait - Charged: $drinkPrice. Remaining credit: " . self::$credit);
    }

    public function returnChange(): int
    {
        Logger::logDebug("CreditHandableTrait - Returning credit: " . self::$credit);
        $change = self::$credit;
        self::$credit = 0; // Reset credit after returning
        Logger::logDebug("CreditHandableTrait - Credit after change returned: " . self::$credit);
        return $change;
    }
}