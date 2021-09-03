<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\ListRequest;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Resources\ClientListResource;
use App\Repositories\ClientRepository;
use App\Repositories\UserRepository;
use App\Services\GeoCoordinatesApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    private UserRepository $userRepository;
    private ClientRepository $clientRepository;
    private GeoCoordinatesApiService $geoCoordinateApiService;

    public function __construct(
        UserRepository $userRepository,
        ClientRepository $clientRepository,
        GeoCoordinatesApiService $geoCoordinateApiService
    )
    {
        $this->userRepository = $userRepository;
        $this->clientRepository = $clientRepository;
        $this->geoCoordinateApiService = $geoCoordinateApiService;
    }

    public function list(ListRequest $request): ClientListResource
    {
        $clients = $this->clientRepository->paginate($request);

        return new ClientListResource($clients);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $coordinates = $this->geoCoordinateApiService->getCoordinatesByAddress($request->getAddress1());

            $client = $this->clientRepository->create($request, $coordinates);

            $this->userRepository->create($request, $client);
        } catch(\Exception $e) {
            DB::rollBack();

            return new JsonResponse($e->getMessage());
        }

        DB::commit();

        return new JsonResponse(null, 201);
    }
}
