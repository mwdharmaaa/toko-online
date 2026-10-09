<?php

namespace App\Domain\Values;

final readonly class StockQuantity
{
    public function __construct(private int $quantity)
    {
    }

    public function isAvailable(): bool
    {
        return $this->quantity > 0;
    }

    public function isLowStock(int $threshold = 5): bool
    {
        return $this->quantity > 0 && $this->quantity <= $threshold;
    }

    public function isDepleted(): bool
    {
        return $this->quantity <= 0;
    }

    public function value(): int
    {
        return max(0, $this->quantity);
    }

    public function badgeText(): string
    {
        if ($this->isDepleted()) {
            return 'Habis';
        }
        if ($this->isLowStock()) {
            return "Tersisa {$this->quantity} unit";
        }
        return "Stok: {$this->quantity}";
    }
}
