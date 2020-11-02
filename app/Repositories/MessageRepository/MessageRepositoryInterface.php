<?php

namespace App\Repositories\MessageRepository;

use App\Models\DynamoTable;
use Illuminate\Support\Collection;

interface MessageRepositoryInterface
{
    public function create(array $data): DynamoTable;

    public function listByPaginate(string $pk) : Collection;
}