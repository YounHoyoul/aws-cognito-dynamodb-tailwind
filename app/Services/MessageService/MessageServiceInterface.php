<?php

namespace App\Services\MessageService;

use App\Models\DynamoTable;
use Illuminate\Support\Collection;

interface MessageServiceInterface 
{
    public function create(array $data): DynamoTable;

    public function listByPaginate(string $pk) : Collection;
}