<?php

namespace App\Repositories;

use App\Http\Requests\Account\Contracts\ClientListModel;
use App\Http\Requests\Account\Contracts\CreateClientModel;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Carbon\Carbon;

class ClientRepository implements ClientRepositoryInterface
{
    protected const FIELD_ALIAS = [
        'id' => 'id',
        'zipCode' => 'zip',
        'phoneNo1' => 'phone_no1',
        'phoneNo2' => 'phone_no2',
        'startValidity' => 'start_validity',
        'endValidity' => 'end_validity',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];

    public function create(CreateClientModel $model, array $coordinate): Client
    {
        $startValidity = Carbon::now();
        $endValidity = $startValidity->addDays(15);

        return Client::query()->firstOrCreate(
            [
                'client_name' => $model->getName(),
                'address1' => $model->getAddress1(),
                'address2' => $model->getAddress2(),
                'city' => $model->getCity(),
                'state' => $model->getState(),
                'country' => $model->getCountry(),
                'zip' => $model->getZipCode(),
                'phone_no1' => $model->getPhoneNo1(),
                'phone_no2' => $model->getPhoneNo2(),
            ],
            [
                'start_validity' => $startValidity,
                'end_validity' => $endValidity,
                'status' => Client::STATUS_ACTIVE,
                'latitude' => $coordinate['lat'],
                'longitude' => $coordinate['lng'],
            ]
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(ClientListModel $model)
    {
        $query = Client::query();

        $whereLike = array_filter(
            [
                'name' => $model->getName(),
                'address1' => $model->getAddress1(),
                'address2' => $model->getAddress2(),
                'city' => $model->getCity(),
                'state' => $model->getState(),
                'country' => $model->getCountry(),
                'zip' => $model->getZipCode(),
                'phone_no1' => $model->getPhoneNo1(),
                'phone_no2' => $model->getPhoneNo2(),
                'id' => $model->getId(),
                'latitude' => $model->getLatitude(),
                'longitude' => $model->getLongitude(),
                'status' => $model->getStatus(),
            ]
        );

        $whereDate = array_filter(
            [
                'start_validity' => $model->getStartValidity(),
                'end_validity' => $model->getEndValidity(),
                'created_at' => $model->getCreatedAt(),
                'updated_at' => $model->getUpdateAt(),
            ]
        );

        foreach ($whereLike as $field => $value) {
            $query->where($field, 'LIKE', sprintf('%%%s%%', $value));
        }

        foreach ($whereDate as $field => $value) {
            $query->whereDate($field, $value);
        }

        return $query
            ->orderBy(static::FIELD_ALIAS[$model->getSort()], $model->getOrder())
            ->paginate();
    }
}
