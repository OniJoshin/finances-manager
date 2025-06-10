<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Imports\IdMappingRegistry;

class IdMappingRegistryTest extends TestCase
{
    public function test_set_and_get_mapping(): void
    {
        $registry = new IdMappingRegistry();
        $registry->set('categories', 1, 100);

        $this->assertTrue($registry->has('categories', 1));
        $this->assertSame(100, $registry->get('categories', 1));
    }

    public function test_get_returns_null_when_mapping_missing(): void
    {
        $registry = new IdMappingRegistry();

        $this->assertNull($registry->get('tags', 999));
        $this->assertFalse($registry->has('tags', 999));
    }


    public function test_set_overwrites_existing_mapping(): void
    {
        $registry = new IdMappingRegistry();
        $registry->set('categories', 1, 100);
        $registry->set('categories', 1, 200);

        $this->assertSame(200, $registry->get('categories', 1));
    }
}
