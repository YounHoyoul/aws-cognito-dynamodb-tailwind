<?php

namespace App\Repositories\SequenceRepository;

use App\Models\DynamoTable;

interface SequenceRepositoryInterface
{
    public function next(string $division): int;

    public function create(string $division): DynamoTable;

    public function delete(string $division): void;
}