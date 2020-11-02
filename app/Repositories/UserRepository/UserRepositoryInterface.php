<?php

namespace App\Repositories\UserRepository;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;

    public function find(string $id): ?User;

    public function findByCredientials($email, $password): ?User;
}