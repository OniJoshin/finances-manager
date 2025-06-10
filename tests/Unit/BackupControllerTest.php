<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\BackupController;

class BackupControllerTest extends TestCase
{
    private function callExtractTarget(string $notes): float
    {
        $controller = new BackupController();
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('extractTargetAmount');
        $method->setAccessible(true);

        return $method->invoke($controller, $notes);
    }

    public function test_extract_target_amount_parses_number_from_notes(): void
    {
        $result = $this->callExtractTarget('My notes Target: 1500 value');
        $this->assertSame(1500.0, $result);
    }

    public function test_extract_target_amount_returns_default_when_missing(): void
    {
        $result = $this->callExtractTarget('no target here');
        $this->assertSame(1000.0, $result);
    }
}
