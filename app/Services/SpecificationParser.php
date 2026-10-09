<?php

namespace App\Services;

use App\Domain\Contracts\SpecificationParserInterface;

class SpecificationParser implements SpecificationParserInterface
{
    public function parse(?string $raw): ?array
    {
        if (blank($raw)) {
            return null;
        }

        $lines = preg_split('/\r\n|\r|\n/', trim($raw));
        $specs = [];

        foreach ($lines as $line) {
            if (str_contains($line, ':')) {
                [$key, $value] = explode(':', $line, 2);
                $keyTrim = trim($key);
                if (!empty($keyTrim)) {
                    $specs[$keyTrim] = trim($value);
                }
            }
        }

        return !empty($specs) ? $specs : null;
    }

    public function format(?array $specifications): string
    {
        if (empty($specifications)) {
            return '';
        }

        $lines = [];
        foreach ($specifications as $key => $val) {
            $lines[] = "{$key}: {$val}";
        }

        return implode("\n", $lines);
    }
}
