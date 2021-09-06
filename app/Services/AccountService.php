<?php

namespace App\Services;

use App\Http\Requests\Account\StoreRequest;
use App\Repositories\ClientRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AccountService
{
    private DatabaseManager $databaseManager;
    private UserRepository $userRepository;
    private ClientRepository $clientRepository;
    private GeoCoordinatesApiService $geoCoordinateApiService;

    public function __construct(
        DatabaseManager $databaseManager,
        UserRepository $userRepository,
        ClientRepository $clientRepository,
        GeoCoordinatesApiService $geoCoordinateApiService
    )
    {
        $this->databaseManager = $databaseManager;
        $this->userRepository = $userRepository;
        $this->clientRepository = $clientRepository;
        $this->geoCoordinateApiService = $geoCoordinateApiService;

    }

    public function create(StoreRequest $request)
    {
        $this->databaseManager->beginTransaction();

        try {
            $coordinates = $this->geoCoordinateApiService->getCoordinatesByAddress($request->getAddress1());

            $client = $this->clientRepository->create($request, $coordinates);

            $this->userRepository->create($request, $client);
        } catch(\Exception $e) {
            $this->databaseManager->rollBack();

            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $this->databaseManager->commit();
    }
}
