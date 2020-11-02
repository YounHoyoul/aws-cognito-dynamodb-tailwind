<?php

namespace App\Providers;

use App\Auth\CognitoUserProvider;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Services\UserService\UserService;
use App\Services\MessageService\MessageService;
use App\Services\SequenceService\SequenceService;
use App\Services\UserService\UserServiceInterface;
use App\Repositories\UserRepository\UserRepository;
use App\Services\MessageService\MessageServiceInterface;
use App\Repositories\MessageRepository\MessageRepository;
use App\Services\SequenceService\SequenceServiceInterface;
use App\Repositories\SequenceRepository\SequenceRepository;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Repositories\MessageRepository\MessageRepositoryInterface;
use App\Repositories\SequenceRepository\SequenceRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $binds = [
            UserServiceInterface::class => UserService::class,
            MessageServiceInterface::class => MessageService::class,
            UserRepositoryInterface::class => UserRepository::class,
            MessageRepositoryInterface::class => MessageRepository::class,
            SequenceServiceInterface::class => SequenceService::class,
            SequenceRepositoryInterface::class => SequenceRepository::class,
        ];

        foreach($binds as $interface => $concrete){
            $this->app->bind($interface, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::provider(CognitoUserProvider::class, function (Container $app) {
            return $app->make(CognitoUserProvider::class);
        });
    }
}
