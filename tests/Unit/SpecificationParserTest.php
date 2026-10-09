<?php

namespace Tests\Unit;

use App\Services\SpecificationParser;
use PHPUnit\Framework\TestCase;

class SpecificationParserTest extends TestCase
{
    public function test_parses_multiline_key_value_string(): void
    {
        $parser = new SpecificationParser();
        $raw = "Material: Cotton 16oz\nDimensi: 40x30 cm";

        $parsed = $parser->parse($raw);
        $this->assertEquals([
            'Material' => 'Cotton 16oz',
            'Dimensi' => '40x30 cm',
        ], $parsed);
    }
}
