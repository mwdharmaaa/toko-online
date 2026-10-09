<?php

namespace App\Domain\Contracts;

interface SpecificationParserInterface
{
    public function parse(?string $raw): ?array;
    public function format(?array $specifications): string;
}
