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


    /**
     * @dataProvider notesProvider
     */
    public function test_extract_target_amount(string $notes, float $expected): void
    {
        $result = $this->callExtractTarget($notes);
        $this->assertSame($expected, $result);
    }

    public static function notesProvider(): array
    {
        return [
            'integer value' => ['My notes Target: 1500 value', 1500.0],
            'decimal value' => ['target: 750.50 more text', 750.50],
            'missing value uses default' => ['no target here', 1000.0],
        ];
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
