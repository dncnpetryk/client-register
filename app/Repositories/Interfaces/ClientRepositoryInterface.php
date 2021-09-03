<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Account\Contracts\ClientListModel;
use App\Http\Requests\Account\Contracts\CreateClientModel;
use App\Models\Client;

interface ClientRepositoryInterface
{
    public function create(CreateClientModel $model, array $coordinate): Client;

    public function paginate(ClientListModel $model);
}
