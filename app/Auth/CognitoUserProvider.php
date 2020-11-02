<?php
namespace App\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use App\Models\User;
use App\Services\UserService\UserServiceInterface;

final class CognitoUserProvider implements UserProvider
{
     /**
     * @var UserServiceInterface
     */
    protected $service;

    /**
     * CognitoUserProvider constructor.
     * @param UserServiceInterface $service
     */
    public function __construct(UserServiceInterface $service) 
    {
        $this->service = $service;
    }

    /**
     * 
     * * @return \App\Models\User
     */
    public function retrieveByCredentials(array $credentials)
    {
        return $this->service->findByCredientials($credentials['email'], $credentials['password']);
    }

    /** @phpstan ignore */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
    }

    /** @phpstan ignore */
    public function retrieveById($identifier)
    {
        return $this->service->find($identifier);
    }

    /** @phpstan ignore */
    public function retrieveByToken($identifier, $token)
    {
    }

    /** @phpstan ignore */
    public function updateRememberToken(Authenticatable $user, $token)
    {
    }
}