<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UserRepository;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class DBUserRepository extends DBRepository implements UserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function login($email, $password): string
    {
        $token = JWTAuth::attempt([
            'email' => $email,
            'password' => $password,
        ]);

        return $token;
    }

    public function logout()
    {
        return JWTAuth::invalidate(true);
    }

    public function getUser()
    {
        return JWTAuth::user();
    }

    public function checkExistEmail(string $email): bool
    {
        return $this->model->where('email', $email)->exists();
    }
}
