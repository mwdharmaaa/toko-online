<?php

namespace App\Services;

use App\Domain\Contracts\CurrencyFormatterInterface;

class CurrencyFormatter implements CurrencyFormatterInterface
{
    public function format(float|int $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    public function parseToFloat(string $formatted): float
    {
        $clean = preg_replace('/[^0-9]/', '', $formatted);
        return (float) $clean;
    }
}
