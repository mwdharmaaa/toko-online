<?php

namespace App\Domain\Values;

final readonly class PhoneNumber
{
    private string $cleaned;

    public function __construct(string $raw)
    {
        $digits = preg_replace('/[^0-9]/', '', $raw);
        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }
        $this->cleaned = $digits;
    }

    public function value(): string
    {
        return $this->cleaned;
    }

    public function toInternationalFormat(): string
    {
        return '+' . $this->cleaned;
    }

    public function __toString(): string
    {
        return $this->cleaned;
    }
}
