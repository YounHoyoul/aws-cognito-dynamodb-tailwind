<?php

namespace App\Services\UserService;

use App\Models\User;

interface UserServiceInterface 
{
    public function create(array $data): User;
    
    public function find(string $id): ?User;

    public function findByCredientials($email, $password): ?User;
}