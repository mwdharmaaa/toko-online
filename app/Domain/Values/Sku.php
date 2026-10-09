<?php

namespace App\Domain\Values;

use InvalidArgumentException;
use Illuminate\Support\Str;

final readonly class Sku
{
    public function __construct(private string $value)
    {
        if (empty(trim($this->value))) {
            throw new InvalidArgumentException("SKU cannot be empty.");
        }
    }

    public static function generate(string $prefix = 'MN'): self
    {
        return new self($prefix . '-' . strtoupper(Str::random(6)));
    }

    public function value(): string
    {
        return strtoupper(trim($this->value));
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
