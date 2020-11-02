<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\DynamoTable;
use App\Services\SequenceService\SequenceServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var DynamoTable
     */
    private $model;

    /**
     * @var SequenceServiceInterface
     */
    private $sequenceService;

    public function __construct(DynamoTable $model, SequenceServiceInterface $sequenceService)
    {
        $this->model = $model;
        $this->sequenceService = $sequenceService;
    }

    public function create(array $data) : User
    {
        $data = $this->model->create([
            "pk" => "user#" . $this->sequenceService->next('user'),
            "sk" => "USER",
            "data" => $data['email'],
            "name" => $data['name'],
            "email" => $data['email'],
            'email_verified_at' => "",
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(10),
        ]);

        $user = new User([
            'id' => $data->pk,
            'name' => $data->name,
            'email' => $data->email,
        ]);

        $user->id = $data->pk;

        return $user;
    }

    public function find(string $id): ?User
    {
        $data = $this->model->where("pk", $id)->first();

        if($data){
            $user = new User([
                'id' => $data->pk,
                'name' => $data->name,
                'email' => $data->email,
            ]);
    
            $user->id = $data->pk;
    
            return $user;
        }

        return null;
    }

    public function findByCredientials($email, $password): ?User
    {
        $data = $this->model->where('sk', "USER")
            ->where('email', $email)
            ->first();

        if(!Hash::check($password, $data->password)){
            return null;
        }

        $user = new User([
            'id' => $data->pk,
            'name' => $data->name,
            'email' => $data->email,
        ]);

        $user->id = $data->pk;

        return $user;
    }
}