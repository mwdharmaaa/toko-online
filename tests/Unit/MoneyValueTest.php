<?php

namespace Tests\Unit;

use App\Domain\Values\Money;
use PHPUnit\Framework\TestCase;

class MoneyValueTest extends TestCase
{
    public function test_formats_indonesian_rupiah_correctly(): void
    {
        $money = Money::fromAmount(350000);
        $this->assertEquals('Rp 350.000', $money->formatIdr());
    }

    public function test_money_addition_and_multiplication(): void
    {
        $m1 = Money::fromAmount(100000);
        $m2 = Money::fromAmount(50000);
        $this->assertEquals(150000, $m1->add($m2)->toAmount());
        $this->assertEquals(300000, $m1->multiply(3)->toAmount());
    }
}
