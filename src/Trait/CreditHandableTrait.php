<?php declare(strict_types=1);

namespace App\Trait;

trait CreditHandableTrait
{
    protected int $credit = 0;

    public function getCredit(): int
    {
        return $this->credit;
    }

    public function addCredit(int $amount): void
    {
        $this->credit += $amount;
    }

    public function returnChange(): int
    {
        $change = $this->credit;
        $this->credit = 0; // Reset credit after returning
        return $change;
    }
}