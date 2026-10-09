<?php

namespace App\Domain\Values;

use Illuminate\Support\Str;

final readonly class Slug
{
    private string $value;

    public function __construct(string $rawTitle)
    {
        $this->value = Str::slug($rawTitle);
    }

    public static function fromString(string $raw): self
    {
        return new self($raw);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
