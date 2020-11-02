<?php
namespace App\Services\SequenceService;

use App\Models\DynamoTable;
use App\Repositories\SequenceRepository\SequenceRepositoryInterface;

class SequenceService implements SequenceServiceInterface
{
    /**
     * @var SequenceRepositoryInterface
     */
    private $repository;

    /**
     * Undocumented function
     * 
     * @param SequenceRepositoryInterface $repository
     */
    public function __construct(SequenceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Undocumented function
     *
     * @param string $division
     * @return integer
     */
    public function next(string $division): int
    {
        return $this->repository->next($division);
    }

    public function create(string $division): DynamoTable
    {
        return $this->repository->create($division);
    }

    public function delete(string $division): void
    {
        $this->repository->delete($division);
    }
}