<?php

namespace App;

trait CreditHandlerTrait
{
    // TODO: verify if we need to use the credit of contexte or not
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