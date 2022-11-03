<?php

namespace App\Repositories;

interface Repository
{
    public function getListJobTitle(): array;

    public function getList(array $params);

    public function generateToken(): string;

    public function getArchiveStatus(): int;
}
