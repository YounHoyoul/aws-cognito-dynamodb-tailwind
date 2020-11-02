<?php

namespace App\Services\UserService;

use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): User
    {
        return $this->repository->create($data);
    }

    public function find(string $id): ?User
    {
        return $this->repository->find($id);
    }

    public function findByCredientials($email, $password): ?User
    {
        return $this->repository->findByCredientials($email, $password);
    }
}