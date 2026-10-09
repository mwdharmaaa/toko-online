<?php

namespace App\Domain\Contracts;

interface CurrencyFormatterInterface
{
    public function format(float|int $amount): string;
}
