<?php

namespace App\Services\MessageService;

use App\Models\DynamoTable;
use Illuminate\Support\Collection;
use App\Repositories\MessageRepository\MessageRepositoryInterface;

class MessageService implements MessageServiceInterface
{
    /**
     * @var MessageRepositoryInterface
     */
    private $repository;

    public function __construct(MessageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): DynamoTable
    {
        return $this->repository->create($data);
    }

    public function listByPaginate(string $pk) : Collection
    {
        return $this->repository->listByPaginate($pk);
    }
}
