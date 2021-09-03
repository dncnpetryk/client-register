<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\Account\Contracts\ClientListModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class ListRequest extends FormRequest implements ClientListModel
{
    protected const SORT_FIELDS = [
        'id',
        'name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'zipCode',
        'latitude',
        'longitude',
        'phoneNo1',
        'phoneNo2',
        'startValidity',
        'endValidity',
        'status',
        'createdAt',
        'updatedAt',
    ];

    public function rules(): array
    {
        return [
            'id' => [
                'integer',
            ],
            'name' => [
                'string'
            ],
            'address1' => [
                'string',
            ],
            'address2' => [
                'string',
            ],
            'city' => [
                'string',
            ],
            'state' => [
                'string',
            ],
            'country' => [
                'string',
            ],
            'zipCode' => [
                'string',
            ],
            'latitude' => [
                'string',
            ],
            'longitude' => [
                'string',
            ],
            'phoneNo1' => [
                'string',
            ],
            'phoneNo2' => [
                'string',
            ],
            'startValidity' => [
                'string',
                'date_format:Y-m-d',
            ],
            'endValidity' => [
                'string',
                'date_format:Y-m-d',
            ],
            'status' => [
                'string',
            ],
            'createdAt' => [
                'string',
                'date_format:Y-m-d',
            ],
            'updatedAt' => [
                'string',
                'date_format:Y-m-d',
            ],
            'sort' => [
                'string',
                'in:'.implode(',', self::SORT_FIELDS),
            ],
            'order' => [
                'string',
                'in:ASC,DESC,asc,desc',
            ],
        ];
    }

    public function getSort(): string
    {
        return $this->input('sort', Arr::first(self::SORT_FIELDS));
    }

    public function getOrder(): string
    {
        return $this->input('order', 'ASC');
    }

    public function getName(): ?string
    {
        return $this->input('name');
    }

    public function getAddress1(): ?string
    {
        return $this->input('address1');
    }

    public function getAddress2(): ?string
    {
        return $this->input('address2');
    }

    public function getCity(): ?string
    {
        return $this->input('city');
    }

    public function getState(): ?string
    {
        return $this->input('state');
    }

    public function getCountry(): ?string
    {
        return $this->input('country');
    }

    public function getZipCode(): ?string
    {
        return $this->input('zipCode');
    }

    public function getPhoneNo1(): ?string
    {
        return $this->input('phoneNo1');
    }

    public function getPhoneNo2(): ?string
    {
        return $this->input('phoneNo2');
    }

    public function getId(): ?int
    {
        return $this->input('id');
    }

    public function getLatitude(): ?float
    {
        return $this->input('latitude');
    }

    public function getLongitude(): ?string
    {
        return $this->input('longitude');
    }

    public function getStatus(): ?string
    {
        return $this->input('status');
    }

    public function getStartValidity(): ?string
    {
        return $this->input('startValidity');
    }

    public function getEndValidity(): ?string
    {
        return $this->input('endValidity');
    }

    public function getCreatedAt(): ?string
    {
        return $this->input('createdAt');
    }

    public function getUpdateAt(): ?string
    {
        return $this->input('updateAt');
    }
}
