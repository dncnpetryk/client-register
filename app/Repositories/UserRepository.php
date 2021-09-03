<?php

namespace App\Repositories;

use App\Http\Requests\Account\Contracts\CreateUserModel;
use App\Models\Client;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create(CreateUserModel $model, Client $client): User
    {
        return User::query()->create([
            'first_name' => $model->getFirstName(),
            'last_name' => $model->getLastName(),
            'email' => $model->getEmail(),
            'password' => Hash::make($model->getPassword()),
            'phone' => $model->getPhone(),
            'status' => User::STATUS_ACTIVE,
            'last_password_reset' => Carbon::now(),
            'client_id' => $client->getKey(),
        ]);
    }

    public function getUsers(array $ids): array
    {
        $data = User::query()->whereIn('client_id', $ids)
            ->groupBy(['client_id', 'status'])
            ->select(DB::raw('DISTINCT client_id, count(*) as count, status'))
            ->get()
            ->toArray();

        $users = [];

        foreach ($data as $params) {
            $key = $params['client_id'];
            $users[$params['client_id']] = array_merge(
                $users[$key] ?? [],
                [
                    $params['status'] => $params['count'],
                ]
            );
        }

        return $users;
    }
}
