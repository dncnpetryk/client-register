<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\ListRequest;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Resources\ClientListResource;
use App\Repositories\ClientRepository;
use App\Services\AccountService;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    private AccountService $accountService;
    private ClientRepository $clientRepository;

    public function __construct(
        AccountService $accountService,
        ClientRepository $clientRepository
    )
    {
        $this->accountService = $accountService;
        $this->clientRepository = $clientRepository;
    }

    public function list(ListRequest $request): ClientListResource
    {
        $clients = $this->clientRepository->paginate($request);

        return new ClientListResource($clients);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->accountService->create($request);
    }
}
