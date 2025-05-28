<?php

namespace App\Imports;

class IdMappingRegistry
{
    protected array $maps = [];

    public function set(string $entity, $oldId, $newId): void
    {
        $this->maps[$entity][$oldId] = $newId;
    }

    public function get(string $entity, $oldId): ?int
    {
        return $this->maps[$entity][$oldId] ?? null;
    }

    public function has(string $entity, $oldId): bool
    {
        return isset($this->maps[$entity][$oldId]);
    }
}
