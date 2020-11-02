<?php
namespace App\Services\SequenceService;

use App\Models\DynamoTable;

interface SequenceServiceInterface
{
    public function next(string $division): int;

    public function create(string $division): DynamoTable;

    public function delete(string $division): void;
}