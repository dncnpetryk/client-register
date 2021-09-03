<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Account\Contracts\CreateUserModel;
use App\Models\Client;
use App\Models\User;

interface UserRepositoryInterface
{
    public function create(CreateUserModel $model, Client $client): User;

    public function getUsers(array $ids): array;
}
