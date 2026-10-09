<?php

namespace App\Domain\Values;

use JsonSerializable;

final readonly class Money implements JsonSerializable
{
    public function __construct(private float $amount)
    {
    }

    public static function fromAmount(float $amount): self
    {
        return new self($amount);
    }

    public static function fromCents(int $cents): self
    {
        return new self($cents / 100);
    }

    public function toAmount(): float
    {
        return $this->amount;
    }

    public function toCents(): int
    {
        return (int) round($this->amount * 100);
    }

    public function formatIdr(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function add(self $other): self
    {
        return new self($this->amount + $other->amount);
    }

    public function multiply(int|float $multiplier): self
    {
        return new self($this->amount * $multiplier);
    }

    public function jsonSerialize(): array
    {
        return [
            'amount' => $this->amount,
            'formatted' => $this->formatIdr(),
        ];
    }
}
