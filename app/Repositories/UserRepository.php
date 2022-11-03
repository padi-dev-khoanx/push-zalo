<?php

namespace App\Repositories;

interface UserRepository
{
    public function login(string $email, string $password): string;

    public function logout();

    public function getUser();

    public function checkExistEmail(string $email): bool;
}
