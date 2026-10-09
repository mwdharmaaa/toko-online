<?php

namespace Tests\Unit;

use App\Services\WhatsAppMessageCompiler;
use PHPUnit\Framework\TestCase;

class WhatsAppCompilerTest extends TestCase
{
    public function test_builds_whatsapp_url_properly(): void
    {
        $compiler = new WhatsAppMessageCompiler();
        $url = $compiler->buildUrl('081234567890', 'Halo Admin');

        $this->assertStringStartsWith('https://wa.me/6281234567890', $url);
        $this->assertStringContainsString('Halo%20Admin', $url);
    }
}
